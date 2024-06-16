<?php

namespace App\Livewire;

use App\Models\ManageTournamentCoach;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrganizateTournamentPuli extends Component
{
    public $tournament;

    public function mount($id)
    {
        $this->tournament = \App\Models\ManageTournament::with('coaches')->find($id);

        if ($this->tournament->organization_id != Auth::id()){
            abort(403);
        }

//        $organizationId = $this->tournament->organization_id;
//        $this->coaches = \App\Models\User::where('organization_id', $organizationId)->get();
//        $this->tournamentCoaches = ManageTournamentCoach::where('tournament_id', $id)->pluck('coach_id')->toArray();
    }

    public function render()
    {
        return view('livewire.organizate-tournament-puli');
    }
}
