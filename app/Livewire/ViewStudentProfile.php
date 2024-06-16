<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewStudentProfile extends Component
{
    public $student;
    public $coach;

    public function mount($id)
    {
        $this->student = User::where('id', $id)->first();
        $this->coach = User::where('id', $this->student->coach_id)->first();
        if (!$this->student || $this->student->coach_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function render()
    {
        return view('livewire.view-student-profile');
    }
}
