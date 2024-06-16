<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class PuliListStudent extends Component
{
    public $studentList;
    public $coaches;

    public function mount($id)
    {
        $this->studentList = \App\Models\ManageTournament::with('students.coach')->find($id);
    }

    public function render()
    {
        return view('livewire.puli-list-student');
    }
}
