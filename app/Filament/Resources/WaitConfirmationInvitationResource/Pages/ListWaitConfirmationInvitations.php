<?php

namespace App\Filament\Resources\WaitConfirmationInvitationResource\Pages;

use App\Filament\Resources\WaitConfirmationInvitationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaitConfirmationInvitations extends ListRecords
{
    protected static string $resource = WaitConfirmationInvitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
