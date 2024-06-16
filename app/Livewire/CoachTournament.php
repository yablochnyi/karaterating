<?php

namespace App\Livewire;

use App\Models\TournamentStudent;
use App\Models\User;
use Livewire\Component;

class CoachTournament extends Component
{
    public $tournaments;

    public function mount()
    {
        $this->tournaments = \App\Models\ManageTournament::whereHas('coaches', function ($query) {
            $query->where('manage_tournament_coaches.coach_id', auth()->id());
        })->with('coaches')->get();

    }

    public function addStudent($studentId, $tournamentId)
    {
        TournamentStudent::create([
            'tournament_id' => $tournamentId,
            'student_id' => $studentId,
        ]);
    }

    public function removeStudent($studentId, $tournamentId)
    {
        TournamentStudent::where('tournament_id', $tournamentId)
            ->where('student_id', $studentId)
            ->delete();
    }

    public function isStudentInTournament($studentId, $tournamentId)
    {
        return TournamentStudent::where('tournament_id', $tournamentId)
            ->where('student_id', $studentId)
            ->exists();
    }

    public function render()
    {
        $students = User::where('coach_id', auth()->id())->get();
        return view('livewire.coach-tournament', compact('students'));
    }
}
