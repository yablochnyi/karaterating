<?php

namespace App\Livewire;

use App\Models\TournamentStudentList;
use App\Models\OrganizatePuliListStudent;
use Livewire\Attributes\On;
use Livewire\Component;

class OrganizatePuliList extends Component
{
    public $tournament;
    public $selectedListId;
    public $students = [];
    public $showModal = false;
    public $selectedStudentId;
    public $targetListId;
    public $tournamentLists;


    protected $listeners = ['openModalExchangeList'];

    public function mount($id)
    {
        $this->tournament = \App\Models\ManageTournament::with('lists')->find($id);
    }

    public function loadStudents($listId)
    {
        $this->selectedListId = $listId;
        $this->students = TournamentStudentList::find($listId)->students()->with('student')->get();
    }
    #[On('openModalExchangeList')]
    public function openModalExchangeList($tournamentId, $studentId)
    {
        $this->selectedStudentId = $studentId;
        $this->tournamentLists = TournamentStudentList::where('tournament_id', $tournamentId)->get();
        $this->showModal = true;
    }

    public function exchange()
    {
        $studentListEntry = OrganizatePuliListStudent::where('student_id', $this->selectedStudentId)
            ->where('list_id', $this->selectedListId)
            ->first();

        if ($studentListEntry) {
            $studentListEntry->list_id = $this->targetListId;
            $studentListEntry->save();

            // Обновление списка студентов после перемещения
            $this->loadStudents($this->selectedListId);

            // Закрытие модального окна
            $this->showModal = false;
        }
    }

    public function render()
    {
        return view('livewire.organizate-puli-list');
    }
}

