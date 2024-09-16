<?php

namespace App\Filament\Resources\TournamentResource\Pages;

use App\Filament\Resources\TournamentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewTournament extends ViewRecord
{
    protected static string $resource = TournamentResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->name;
    }
}
