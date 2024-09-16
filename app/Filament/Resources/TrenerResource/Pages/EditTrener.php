<?php

namespace App\Filament\Resources\TrenerResource\Pages;

use App\Filament\Resources\TrenerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrener extends EditRecord
{
    protected static string $resource = TrenerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
