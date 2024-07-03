<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SessionLists extends Component
{
    protected $listeners = ['updatedSessionList' => '$refresh'];

    public function render()
    {
        return view('livewire.components.session-lists');
    }
}
