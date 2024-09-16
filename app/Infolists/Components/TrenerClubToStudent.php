<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Entry;

class TrenerClubToStudent extends Entry
{
    protected string $view = 'infolists.components.trener-club-to-student';

    public function mount(): void
    {
        dd($this->getState());
    }
}
