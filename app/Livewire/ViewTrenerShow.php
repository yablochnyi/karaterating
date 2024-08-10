<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewTrenerShow extends Component
{
    public $coach;
    public function mount($id)
    {

        $this->coach = User::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.view-trener-show');
    }
}
