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
use Filament\Forms\Components\Section;
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

    public array $tatami_and_fight_number = [];

    public function updatedTatamiAndFightNumber($value, $key)
    {

        Pool::find($key)->update([
            'tatami_and_fight_number' => $value,
        ]);
    }

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
        $this->tatami_and_fight_number = $this->tournament->pools->pluck('tatami_and_fight_number', 'id')->toArray();

    }

    public function winnerAction(): Action
    {
        return Action::make('winner')
            ->label('Опции')
            ->color('success')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-trophy')
            ->modalDescription('Выберите победителя или отметьте неявку на турнир')
            ->form(function (array $arguments) {
                $pool = Pool::find($arguments['id']);
                return [
                    // Блок для выбора победителя
                    Section::make('Победитель')
                        ->description('Выберите участника, который победил в турнире.')
                        ->schema([
                            Radio::make('winner_id')
                                ->options($this->getPoolParticipants($arguments['id']))
                                ->nullable()
                                ->label('Победитель'),
                        ]),

                    // Блок для отметки неявившегося
                    Section::make('Неявка')
                        ->description('Укажите, кто из участников не явился на турнир.')
                        ->schema([
                            Radio::make('absent_id')
                                ->options($this->getPoolParticipants($arguments['id']))
                                ->nullable()
                                ->hidden(fn() => $pool->winner_id || $pool->round != 1)
                                ->label('Неявился'),
                        ]),
                ];
            })
            ->action(function (array $data, array $arguments) {
                $pool = Pool::find($arguments['id']);

                // Обработка информации о том, кто не явился
                if (!empty($data['absent_id'])) {
                    $this->handleAbsence($pool, $data['absent_id']);
                } else {
                    // Обработка информации о победителе
                    if (!empty($data['winner_id'])) {
                        $pool->winner_id = $data['winner_id'];
                        $pool->save();

                        // Переносим победителя в следующий раунд
                        $this->moveWinnerToNextRound($pool, $data['winner_id']);
                    }
                }

                $this->mount($pool->list_id, $pool->tournament_id);
                return redirect()->to(request()->header('Referer'));

            });
    }

    public function getPoolParticipants($poolId)
    {
        $pool = Pool::find($poolId);

        return [
            $pool->student->id => $pool->student->last_name . ' ' . $pool->student->first_name,
            $pool->opponent->id => $pool->opponent->last_name . ' ' . $pool->opponent->first_name,
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
            } elseif ($nextPool->opponent_id == $currentPool->opponent_id || $nextPool->opponent_id == $currentPool->student_id) {
                $nextPool->opponent_id = null;
            }

            $totalPools = Pool::where('tournament_id', $currentPool->tournament_id)
                ->where('list_id', $currentPool->list_id)
                ->get();

            $currentPoolIndex = $totalPools->search(function ($pool) use ($currentPool) {
                return $pool->id === $currentPool->id + 1; // Сравниваем ID текущего пула
            });

            if ($currentPoolIndex % 2 == 0) {
                if (is_null($nextPool->opponent_id)) {
                    $nextPool->opponent_id = $winnerId;
                }
            } else {
                if (is_null($nextPool->student_id)) {
                    $nextPool->student_id = $winnerId;
                }
            }


//                if (is_null($nextPool->student_id)) {
//                    $nextPool->student_id = $winnerId;
//                } elseif (is_null($nextPool->opponent_id)) {
//                    $nextPool->opponent_id = $winnerId;
//                } else {
//                    Log::warning("Не удалось переместить победителя в раунд {$nextRound} позиции {$nextPosition}, так как обе ячейки заняты.");
//                    return;
//                }

            $nextPool->save();
        }
    }

    protected
    function handleAbsence(Pool $pool, $absentId)
    {
        // Определяем противника
        $studentId = ($pool->student_id == $absentId) ? $pool->opponent_id : $pool->student_id;

        // Удаляем отсутствующего из моделей
        $this->removeFromTournament($pool, $absentId);

        // Переносим противника в следующий раунд
        if (!empty($studentId)) {
            $this->moveWinnerToNextRound($pool, $studentId);
        }

        // Обновляем текущий Pool, удаляя отсутствующего
        if ($pool->student_id == $absentId) {
            $pool->student_id = null;
        } elseif ($pool->opponent_id == $absentId) {
            $pool->opponent_id = null;
        }
        $pool->save();
    }

    protected
    function removeFromTournament(Pool $pool, $absentId)
    {
        // Устанавливаем student_id и opponent_id в null для записей, где они равны $absentId
        if ($pool->type === 'Round Robin') {
            // Удаляем записи вместо их обновления
            Pool::where('tournament_id', $pool->tournament_id)
                ->where(function ($query) use ($absentId) {
                    $query->where('student_id', $absentId)
                        ->orWhere('opponent_id', $absentId);
                })
                ->delete();
        } else {
            // Устанавливаем student_id и opponent_id в null для записей, где они равны $absentId
            Pool::where('tournament_id', $pool->tournament_id)
                ->where(function ($query) use ($absentId) {
                    $query->where('student_id', $absentId)
                        ->orWhere('opponent_id', $absentId);
                })
                ->update([
                    'student_id' => null,
                    'opponent_id' => null,
                ]);
        }

        // Удаляем запись из TournamentStudentList через связь
        $pool->listTournament->students()
            ->where('student_id', $absentId)
            ->delete();

        // Удаляем из Tournament
        $tournament = Tournament::find($pool->tournament_id);
        if ($tournament) {
            $tournament->students()->detach($absentId);
        }
    }


    public
    function winnerForThreeStudentsAction(): Action
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
                        ->options($userOptions),
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

    protected
    function moveLoserToThirdPlace(Pool $pool, $loserId)
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
                $totalPools = Pool::where('tournament_id', $pool->tournament_id)
                    ->where('list_id', $pool->list_id)
                    ->get();

                $currentPoolIndex = $totalPools->search(function ($value) use ($pool) {
                    return $value->id === $pool->id + 1; // Сравниваем ID текущего пула
                });

                if ($currentPoolIndex % 2 == 0) {
                    if (is_null($thirdPlacePool->opponent_id)) {
                        $thirdPlacePool->opponent_id = $loserId;
                    }
                } else {
                    if (is_null($thirdPlacePool->student_id)) {
                        $thirdPlacePool->student_id = $loserId;
                    }
                }
            }

            $thirdPlacePool->save();
        }
    }

    public
    function swapParticipantsAction(): Action
    {
        return Action::make('swapParticipants')
            ->label('Переместить участников')
            ->color('primary')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-trophy')
            ->modalDescription('Выберите двух участников для перемещения')
            ->form(function (array $arguments) {
                $pools = $arguments['pools'] ?? [];
                $participants = collect($pools)
                    ->flatMap(function ($pool) {
                        return [
                            $pool['student_id'],
                            $pool['opponent_id'],
                        ];
                    })
                    ->unique();

                // Получаем пользователей
                $users = User::whereIn('id', $participants)->get();

                // Генерируем массив с именами участников
                $userOptions = $users->mapWithKeys(function ($user) {
                    return [$user->id => $user->first_name . ' ' . $user->last_name];
                });

                return [
                    Select::make('participant_1')
                        ->label('Первый участник')
                        ->options($userOptions)
                        ->required(),
                    Select::make('participant_2')
                        ->label('Второй участник')
                        ->options($userOptions)
                        ->required(),
                ];
            })
            ->action(function (array $data, array $arguments) {
                $pools = $arguments['pools'] ?? [];

                $participant1 = $data['participant_1'];
                $participant2 = $data['participant_2'];

                if ($participant1 === $participant2) {
                    Notification::make()
                        ->title('Участники не могут быть одинаковыми')
                        ->danger()
                        ->send();

                    return;
                }

                // Ищем все пулы для каждого участника
                $pool1Matches = collect($pools)->filter(function ($pool) use ($participant1) {
                    return $pool['student_id'] == $participant1 || $pool['opponent_id'] == $participant1;
                });

                $pool2Matches = collect($pools)->filter(function ($pool) use ($participant2) {
                    return $pool['student_id'] == $participant2 || $pool['opponent_id'] == $participant2;
                });

                if ($pool1Matches->isEmpty() || $pool2Matches->isEmpty()) {
                    Notification::make()
                        ->title('Не удалось найти участников в пулах')
                        ->danger()
                        ->send();

                    return;
                }

                $pool1 = $pool1Matches->first();
                $pool2 = $pool2Matches->first();

                $participant1Position = '';
                // Проверяем, где находится первый участник
                if ($pool1['student_id'] == $participant1) {
                    // Участник 1 — студент
                    $participant1Position = 'student_id';
                } elseif ($pool1['opponent_id'] == $participant1) {
                    // Участник 1 — оппонент
                    $participant1Position = 'opponent_id';
                }

                $participant2Position = 'student_id';
                // Проверяем, где находится второй участник
                if ($pool2['student_id'] == $participant2) {
                    // Участник 2 — студент
                    $participant2Position = 'student_id';
                } elseif ($pool2['opponent_id'] == $participant2) {
                    // Участник 2 — оппонент
                    $participant2Position = 'opponent_id';
                }

// Меняем местами участников
                $temp = $pool1[$participant1Position];
                $pool1[$participant1Position] = $pool2[$participant2Position];
                $pool2[$participant2Position] = $temp;

// Сохраняем изменения в базе данных
                DB::table('pools')->where('id', $pool1['id'])->update([
                    'student_id' => $pool1['student_id'],
                    'opponent_id' => $pool1['opponent_id'],
                ]);

                DB::table('pools')->where('id', $pool2['id'])->update([
                    'student_id' => $pool2['student_id'],
                    'opponent_id' => $pool2['opponent_id'],
                ]);


                Notification::make()
                    ->title('Участники успешно перемещены')
                    ->success()
                    ->send();

                return redirect()->to(request()->header('Referer'));
            });

    }


}
