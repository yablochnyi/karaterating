<?php

namespace App\Filament\Resources\ScaleResource\Pages;

use App\Filament\Resources\ScaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScales extends ListRecords
{
    protected static string $resource = ScaleResource::class;

    public static ?string $title = 'Масштабы турнира';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
