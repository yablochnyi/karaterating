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

    public $editList = false;

    public $name;
    public $ageFrom;
    public $ageTo;
    public $weightFrom;
    public $weightTo;
    public $kyuFrom;
    public $kyuTo;
    public $gender;

    protected $rules = [
        'name' => 'required|string|max:255',
        'ageFrom' => 'required|integer|min:0',
        'ageTo' => 'required|integer|min:0',
        'weightFrom' => 'required|integer|min:0',
        'weightTo' => 'required|integer|min:0',
        'kyuFrom' => 'required|integer|min:0',
        'kyuTo' => 'required|integer|min:0',
        'gender' => 'required|string|in:М,Ж',
    ];


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

    public function editMatchDetails($listId)
    {
        $this->tournamentLists = TournamentStudentList::find($listId);
        $this->name = $this->tournamentLists->name;
        $this->ageFrom = $this->tournamentLists->age_from;
        $this->ageTo = $this->tournamentLists->age_to;
        $this->weightFrom = $this->tournamentLists->weight_from;
        $this->weightTo = $this->tournamentLists->weight_to;
        $this->kyuFrom = $this->tournamentLists->kyu_from;
        $this->kyuTo = $this->tournamentLists->kyu_to;
        $this->gender = $this->tournamentLists->gender;
        $this->editList = true;
    }

    public function updateList()
    {
        $this->validate();

        $list = TournamentStudentList::find($this->tournamentLists->id);
        $list->update([
            'name' => $this->name,
            'age_from' => $this->ageFrom,
            'age_to' => $this->ageTo,
            'weight_from' => $this->weightFrom,
            'weight_to' => $this->weightTo,
            'kyu_from' => $this->kyuFrom,
            'kyu_to' => $this->kyuTo,
            'gender' => $this->gender,
        ]);

        $this->editList = false;
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

