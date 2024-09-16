<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->first_name . ' ' . $this->record->last_name;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->visible(auth()->user()->role_id == User::Coach),
        ];
    }
}
