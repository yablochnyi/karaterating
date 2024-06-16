<?php

namespace App\Livewire;

use App\Http\Middleware\AuthCoach;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $student;
    public $coach;

    public function mount()
    {
        $this->student = User::where('id', Auth::id())->with('tournaments')->first();
        $this->coach = User::where('id', $this->student->coach_id)->first();
    }

    public function refuseTournament($tournamentId)
    {
        $student = User::with('tournaments')->find($this->student->id);
        $student->tournaments()->updateExistingPivot($tournamentId, ['is_success' => false]);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
