<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewStudentProfile extends Component
{
    public $student;
    public $coach;
    public $weight;
    public $isEditing = false;

    public function mount($id)
    {
        $this->student = User::where('id', $id)->first();
        $this->coach = User::where('id', $this->student->coach_id)->first();
        $this->weight = $this->student->weight;
        if (!$this->student || $this->student->coach_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function editWeight()
    {
        $this->isEditing = true;
    }

    public function saveWeight()
    {
        $this->validate([
            'weight' => 'required|numeric|min:0',
        ]);

        $this->student->weight = $this->weight;
        $this->student->save();

        $this->isEditing = false;

    }
    public function render()
    {
        return view('livewire.view-student-profile');
    }
}
