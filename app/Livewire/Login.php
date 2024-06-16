<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|string')]
    public $email;
    #[Validate('required|string')]
    public $password;

    public function register()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->redirect(FilterRegion::class);
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
