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
                ->action(function($record) {
                    $index = new GeneratePuliController();
                    $index->generate($record->id);
            })
            ->label('Сгенерировать пули'),
            Actions\DeleteAction::make(),
        ];
    }
}
