<?php

namespace App\Filament\Resources\TemplateStudentListResource\Pages;

use App\Filament\Resources\TemplateStudentListResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTemplateStudentList extends CreateRecord
{
    protected static string $resource = TemplateStudentListResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
