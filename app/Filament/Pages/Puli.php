<?php

namespace App\Filament\Pages;

use App\Models\Pool;
use App\Models\TemplateStudentList;
use App\Models\Tournament;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Puli extends Page implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static string $view = 'filament.pages.puli';

    protected static ?string $slug = 'tournament-puli/{listId}/tournament/{tournamentId}';

    public $tournament;

    public $titleList;

    public $selectedParticipant1 = null;
    public $selectedParticipant2 = null;
    public $isSwappingMode = false;

    public function getTitle(): string|Htmlable
    {
        return __($this->titleList);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount($listId, $tournamentId)
    {

        $this->tournament = Tournament::with([
            'pools' => function ($query) use ($listId, $tournamentId) {
                $query->where('list_id', $listId)
                    ->where('tournament_id', $tournamentId);
            },
            'pools.student',
            'pools.opponent',
            'pools.listTournament.templateStudentList' // Подгружаем TemplateStudentList через ListTournament
        ])->findOrFail($tournamentId);

        // Получаем title из TemplateStudentList и сохраняем в свойство
        $this->titleList = $this->tournament->pools->first()->listTournament->templateStudentList->name ?? 'Default Title';

    }

    public function winnerAction(): Action
    {
        return Action::make('winner')
            ->label('Победитель')
            ->color('success')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-trophy')
            ->modalDescription('Выберите победителя')
            ->form(function (array $arguments) {
                $pool = Pool::find($arguments['id']);
                return [
                    Radio::make('winner_id')
                        ->hiddenLabel()
                        ->options($this->getPoolParticipants($arguments['id']))
                        ->default($pool->winner_id)
                        ->required(),
                ];
            })
            ->action(function (array $data, array $arguments) {
                $pool = Pool::find($arguments['id']);
                $pool->winner_id = $data['winner_id'];
                $pool->save();

                // Переносим победителя в следующий раунд
                $this->moveWinnerToNextRound($pool, $data['winner_id']);

                $this->mount($pool->list_id, $pool->tournament_id);
                return redirect()->to(request()->header('Referer'));
//                Notification::make()
//                    ->title('Данные сохранены')
//                    ->success()
//                    ->send();
            });
    }

    public function winnerForThreeStudentsAction(): Action
    {
        return Action::make('winnerForThreeStudents')
            ->label('Победитель')
            ->color('success')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-trophy')
            ->modalDescription('Выберите победителя')
            ->form(function (array $arguments) {
                $pools = $arguments['pools'] ?? [];
                $participants = collect($pools)
                    ->flatMap(function ($pool) {
                        return [
                            $pool['student_id'],
                            $pool['opponent_id'],
                        ];
                    })
                    ->unique(); // Убираем дубликаты

                // Получаем пользователей
                $users = User::whereIn('id', $participants)->get();

                // Генерируем массив с именами участников
                $userOptions = $users->mapWithKeys(function ($user) {
                    return [$user->id => $user->first_name . ' ' . $user->last_name]; // ID => Имя
                });

                return [
                    Select::make('winner_id_1rd_robbin')
                        ->label('1-е место')
                        ->options($userOptions) // Используем имена для выбора
                        ->required(),
                    Select::make('winner_id_2rd_robbin')
                        ->label('2-е место')
                        ->options($userOptions) // Используем имена для выбора
                        ->required(),
                    Select::make('winner_id_3rd_robbin')
                        ->label('3-е место')
                        ->options($userOptions) // Используем имена для выбора
                        ->required(),
                ];
            })
            ->action(function (array $data, array $arguments) {
                foreach ($arguments['pools'] as $pool) {
                    DB::table('pools')
                        ->where('id', $pool['id'])
                        ->update([
                            'winner_id_1rd_robbin' => $data['winner_id_1rd_robbin'],
                            'winner_id_2rd_robbin' => $data['winner_id_2rd_robbin'],
                            'winner_id_3rd_robbin' => $data['winner_id_3rd_robbin'],
                        ]);
                }
                return redirect()->to(request()->header('Referer'));
//                Notification::make()
//                    ->title('Данные сохранены')
//                    ->success()
//                    ->send();
            });
    }

    public function getPoolParticipants($poolId)
    {
        $pool = Pool::find($poolId);

        return [
            $pool->student->id => $pool->student->first_name . ' ' . $pool->student->last_name,
            $pool->opponent->id => $pool->opponent->first_name . ' ' . $pool->opponent->last_name,
        ];
    }

    protected function moveWinnerToNextRound(Pool $currentPool, $winnerId)
    {
        // Если текущий бой является финальным, не перемещаем победителя
        if ($currentPool->type === 'final') {
            return;
        }

        $nextRound = $currentPool->round + 1;
        $nextPosition = intdiv($currentPool->position_in_round - 1, 2) + 1;

        // Проверка на полуфинал для боя за 3 место
        if ($currentPool->type === '1/2') {
            $loserId = ($currentPool->student_id == $winnerId) ? $currentPool->opponent_id : $currentPool->student_id;
            $this->moveLoserToThirdPlace($currentPool, $loserId);
        }

        $nextPool = Pool::where('tournament_id', $currentPool->tournament_id)
            ->where('list_id', $currentPool->list_id)
            ->where('round', $nextRound)
            ->where('position_in_round', $nextPosition)
            ->first();

        if ($nextPool) {
            // Если студент или оппонент в следующем пуле — это предыдущий победитель, убираем его
            if ($nextPool->student_id == $currentPool->student_id || $nextPool->student_id == $currentPool->opponent_id) {
                $nextPool->student_id = null;
            } elseif ($nextPool->opponent_id == $currentPool->opponent_id || $nextPool->opponent_id == $currentPool->opponent_id) {
                $nextPool->opponent_id = null;
            }

            // Заполняем победителем свободное место
            if (is_null($nextPool->student_id)) {
                $nextPool->student_id = $winnerId;
            } elseif (is_null($nextPool->opponent_id)) {
                $nextPool->opponent_id = $winnerId;
            } else {
                Log::warning("Не удалось переместить победителя в раунд {$nextRound} позиции {$nextPosition}, так как обе ячейки заняты.");
                return;
            }

            $nextPool->save();
        }
    }

    protected function moveLoserToThirdPlace(Pool $pool, $loserId)
    {
        // Убедимся, что проигравший существует
        if ($loserId) {
            // Находим или создаем бой за 3-е место
            $thirdPlacePool = Pool::firstOrCreate(
                [
                    'tournament_id' => $pool->tournament_id,
                    'list_id' => $pool->list_id,
                    'type' => '3rd',
                ],
                [
                    'student_id' => null,
                    'opponent_id' => null,
                ]
            );

            // Проверяем, если один из участников текущего боя уже занимает позицию в пуле за 3-е место
            if ($thirdPlacePool->student_id == $pool->student_id || $thirdPlacePool->student_id == $pool->opponent_id) {
                // Если студент уже находится в позиции student_id, заменим его на нового проигравшего
                $thirdPlacePool->student_id = $loserId;
            } elseif ($thirdPlacePool->opponent_id == $pool->student_id || $thirdPlacePool->opponent_id == $pool->opponent_id) {
                // Если студент уже находится в позиции opponent_id, заменим его на нового проигравшего
                $thirdPlacePool->opponent_id = $loserId;
            } else {
                // Если оба места свободны, добавляем проигравшего в первую свободную позицию
                if (is_null($thirdPlacePool->student_id)) {
                    $thirdPlacePool->student_id = $loserId;
                } elseif (is_null($thirdPlacePool->opponent_id)) {
                    $thirdPlacePool->opponent_id = $loserId;
                }
            }

            $thirdPlacePool->save();
        }
    }

    public function toggleSwapping()
    {
        $this->isSwappingMode = !$this->isSwappingMode;
        $this->selectedParticipant1 = null;
        $this->selectedParticipant2 = null;
    }

    public function selectParticipant($participantId)
    {
        if (!$this->isSwappingMode) {
            return;
        }

        if (is_null($this->selectedParticipant1)) {
            $this->selectedParticipant1 = $participantId;
        } elseif (is_null($this->selectedParticipant2)) {
            $this->selectedParticipant2 = $participantId;
            $this->swapParticipants(); // После выбора второго участника выполняем обмен
        }
    }

    public function swapParticipants()
    {
        // Обмен местами двух участников
        $pool1 = Pool::where('student_id', $this->selectedParticipant1)
            ->orWhere('opponent_id', $this->selectedParticipant1)
            ->first();

        $pool2 = Pool::where('student_id', $this->selectedParticipant2)
            ->orWhere('opponent_id', $this->selectedParticipant2)
            ->first();

        if ($pool1 && $pool2) {
            // Меняем их местами
            $tempStudentId = $pool1->student_id;
            $pool1->student_id = $pool2->student_id;
            $pool2->student_id = $tempStudentId;

            $tempOpponentId = $pool1->opponent_id;
            $pool1->opponent_id = $pool2->opponent_id;
            $pool2->opponent_id = $tempOpponentId;

            $pool1->save();
            $pool2->save();
        }

        // Сбрасываем режим и выбранных участников
        $this->selectedParticipant1 = null;
        $this->selectedParticipant2 = null;
        $this->isSwappingMode = false;

        session()->flash('message', 'Участники успешно поменялись местами!');
    }


}
