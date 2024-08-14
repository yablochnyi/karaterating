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
    public $coachBelongsToOrganizer;

    public function mount($id)
    {
        $this->student = User::where('id', $id)->first();

        // Проверяем, существует ли студент
        if (!$this->student) {
            abort(404, 'Student not found.');
        }

        $this->coach = User::where('id', $this->student->coach_id)->first();
        $this->weight = $this->student->weight;

        // Проверка, если текущий пользователь является тренером студента
        if ($this->student->coach_id === Auth::id()) {
            return;
        }

        // Проверка, если текущий пользователь является организатором
        if (Auth::user()->role_id === 2) {
            // Предполагается, что у организатора есть связь с тренерами, например, через `organizer_id` в модели `User`
            $this->coachBelongsToOrganizer = User::where('id', $this->student->coach_id)
                ->where('organization_id', Auth::id())
                ->exists();

            if ($this->coachBelongsToOrganizer) {
                return;
            }
        }

        // Если ни одно из условий не выполнено, доступ запрещен
        abort(403, 'Unauthorized action.');
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
