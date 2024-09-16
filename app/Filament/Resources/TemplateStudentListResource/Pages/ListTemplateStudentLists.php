<?php

namespace App\Filament\Resources\TemplateStudentListResource\Pages;

use App\Filament\Resources\TemplateStudentListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplateStudentLists extends ListRecords
{
    protected static string $resource = TemplateStudentListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
