<?php

namespace App\Filament\Resources\TrenerResource\Pages;

use App\Filament\Resources\TrenerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewTrener extends ViewRecord
{
    protected static string $resource = TrenerResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->first_name . ' ' . $this->record->last_name;
    }
}
