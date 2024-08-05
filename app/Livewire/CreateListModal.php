<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CreateListModal extends Component
{
    public $showModal = false;
    public $name;
    public $ageFrom;
    public $ageTo;
    public $weightFrom;
    public $weightTo;
    public $kyuFrom;
    public $kyuTo;
    public $gender;
    public $listIndex;

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

    public function mount()
    {
        $this->resetForm();
        $this->showModal = false;

        $this->listeners = ['openModal' => 'showModal'];
    }
    #[On('openModal')]
    public function showModal()
    {
        $this->showModal = true;
    }


    public function createList()
    {
        $this->validate();

        $list = [
            'name' => $this->name,
            'age_from' => $this->ageFrom,
            'age_to' => $this->ageTo,
            'weight_from' => $this->weightFrom,
            'weight_to' => $this->weightTo,
            'kyu_from' => $this->kyuFrom,
            'kyu_to' => $this->kyuTo,
            'gender' => $this->gender,
        ];

        session()->push('lists', $list);

        $this->resetForm();
        $this->dispatch('updatedSessionList');
        $this->showModal = false;
    }
    #[On('openEditModal')]
    public function editList($id)
    {
        $lists = session('lists', []);
        $list = $lists[$id];

        $this->listIndex = $id;
        $this->name = $list['name'];
        $this->ageFrom = $list['age_from'];
        $this->ageTo = $list['age_to'];
        $this->weightFrom = $list['weight_from'];
        $this->weightTo = $list['weight_to'];
        $this->kyuFrom = $list['kyu_from'];
        $this->kyuTo = $list['kyu_to'];
        $this->gender = $list['gender'];

        $this->showModal = true;
    }

    public function updateList()
    {
        $this->validate();

        $lists = session('lists', []);
        $lists[$this->listIndex] = [
            'name' => $this->name,
            'age_from' => $this->ageFrom,
            'age_to' => $this->ageTo,
            'weight_from' => $this->weightFrom,
            'weight_to' => $this->weightTo,
            'kyu_from' => $this->kyuFrom,
            'kyu_to' => $this->kyuTo,
            'gender' => $this->gender,
        ];

        session()->put('lists', $lists);

        $this->resetForm();
        $this->dispatch('updatedSessionList');
        $this->showModal = false;
    }

    public function deleteList()
    {
        $lists = session('lists', []);
        unset($lists[$this->listIndex]);

        // Reindex the array to prevent issues with non-sequential keys
        session()->put('lists', array_values($lists));

        $this->resetForm();
        $this->showModal = false;

        $this->dispatch('updatedSessionList');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->ageFrom = '';
        $this->ageTo = '';
        $this->weightFrom = '';
        $this->weightTo = '';
        $this->kyuFrom = '';
        $this->kyuTo = '';
        $this->gender = '';
    }

    public function render()
    {
        return view('livewire.create-list-modal');
    }
}

