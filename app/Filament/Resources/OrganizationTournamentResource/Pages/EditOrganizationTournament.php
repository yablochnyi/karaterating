<?php

namespace App\Filament\Resources\OrganizationTournamentResource\Pages;

use App\Filament\Resources\OrganizationTournamentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationTournament extends EditRecord
{
    protected static string $resource = OrganizationTournamentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
