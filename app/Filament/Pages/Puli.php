<?php

namespace App\Filament\Pages;

use App\Models\Pool;
use App\Models\Tournament;
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

class Puli extends Page implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.puli';

    public $tournament;

    public function mount()
    {
        $tournamentId = 7; // ID турнира
        $this->tournament = Tournament::with(['pools.student', 'pools.opponent'])->findOrFail($tournamentId);

//        dd($tournament);
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
                        ->options($this->getPoolParticipants($arguments['id'])) // Получаем участников по ID пула
                        ->default($pool->winner_id)
                        ->required(),
                ];
            })
            ->action(function (array $data, array $arguments) {
                $pool = Pool::find($arguments['id']);
                $pool->winner_id = $data['winner_id'];
                $pool->save();
                Notification::make()
                    ->title('Данные сохранены')
                    ->success()
                    ->send();
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

}
