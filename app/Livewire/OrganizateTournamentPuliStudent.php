<?php

namespace App\Livewire;

use App\Models\ManageTournament;
use App\Models\MatchPool;
use App\Models\Pool;
use App\Models\TournamentStudentList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrganizateTournamentPuliStudent extends Component
{
    public function render()
    {
        return view('livewire.organizate-tournament-puli-student');
    }
}
