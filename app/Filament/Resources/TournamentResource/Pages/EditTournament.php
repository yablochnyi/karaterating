<?php

namespace App\Filament\Resources\TournamentResource\Pages;

use App\Filament\Resources\TournamentResource;
use App\Http\Controllers\GeneratePuliController;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTournament extends EditRecord
{
    protected static string $resource = TournamentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('generate_puli')
                ->action(function ($record) {
                    $index = new GeneratePuliController();
                    $index->generate($record->id);
                })
                ->label(function ($record) {
                    // Проверяем, существуют ли пули для данного турнира
                    return $record->pools()->exists() ? 'Перегенерировать пули' : 'Сгенерировать пули';
                })
                ->requiresConfirmation(function ($record) {
                    return $record->pools()->exists();
                })
                ->modalHeading(fn($record) => $record->pools()->exists() ? 'Перегенерация' : 'Подтверждение')
                ->modalDescription(fn($record) => $record->pools()->exists()
                    ? 'Пули уже сгенерированы. Вы уверены, что хотите перегенерировать их?'
                    : 'Вы уверены, что хотите сгенерировать пули для этого турнира?'),

            Actions\DeleteAction::make(),
        ];
    }

}
