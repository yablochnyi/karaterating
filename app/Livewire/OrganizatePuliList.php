<?php

namespace App\Livewire;

use Livewire\Component;

class OrganizatePuliList extends Component
{
    public $tournament;

    public function mount($id)
    {
        $this->tournament = \App\Models\ManageTournament::with('lists')->find($id);
    }


    public function render()
    {
        return view('livewire.organizate-puli-list');
    }
}
