<?php

namespace App\Filament\Resources\TournamentResource\Pages;

use App\Filament\Resources\TournamentResource;
use App\Models\TemplateStudentList;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTournament extends CreateRecord
{
    protected static string $resource = TournamentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
//        $lists = TemplateStudentList::where('user_id', auth()->id())->get();
//        foreach ($lists as $list) {
//
//        }
        $data['organization_id'] = auth()->id();

        return $data;
    }

    protected function afterCreate(): void
    {
        $lists = TemplateStudentList::where('user_id', auth()->id())->pluck('id')->toArray();

        $this->record->lists()->sync($lists);
    }
}
