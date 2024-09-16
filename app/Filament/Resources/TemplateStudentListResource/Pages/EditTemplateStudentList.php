<?php

namespace App\Filament\Resources\TemplateStudentListResource\Pages;

use App\Filament\Resources\TemplateStudentListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateStudentList extends EditRecord
{
    protected static string $resource = TemplateStudentListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
