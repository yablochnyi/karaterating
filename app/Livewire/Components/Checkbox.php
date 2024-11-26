<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Checkbox extends Component
{
    public $record;
    public $state;
    public $entry;

    public function mount($record, $entry)
    {
        $this->record = $record;
        $this->entry = $entry->getName();
        $this->state = $record->{$this->entry};
    }

    public function toggleState()
    {
        $this->record->update([
            $this->entry => $this->state,
        ]);
    }




    public function render()
    {
        return view('livewire.components.checkbox');
    }
}
