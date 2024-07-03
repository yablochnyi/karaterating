<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WaitConfirmationInvitationStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{

    #[Validate('required|string')]
    public $email;
    #[Validate('required|string')]
    public $password;

    public function mount()
    {
        if (request()->has('ref')) {
            Session::put('referrer', request()->ref);
        } else {
            abort(404);
        }
    }

    public function register()
    {
        $this->validate();

        $referrer = null;
        if (Session::has('referrer')) {
            $referrer = User::where('ref_token', Session::get('referrer'))->first();
            $referrer = $referrer ? $referrer : null;
            Session::forget('referrer');
        }

        $userData = [
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];

        if ($referrer) {
            if ($referrer->role_id == User::Organization) {
                $userData['organization_id'] = $referrer->id;
                $userData['role_id'] = User::Coach;
            } elseif ($referrer->role_id == User::Coach) {
                $userData['coach_id'] = $referrer->id;
                $userData['role_id'] = User::Student;
            }
        }

        $user = User::create($userData);


        Auth::login($user);

        $confirm = WaitConfirmationInvitationStudent::where('email', $this->email)->first();
        if ($confirm) {
            $confirm->confirmed = true;
            $confirm->save();
        }



        return redirect()->route('edit.profile');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
