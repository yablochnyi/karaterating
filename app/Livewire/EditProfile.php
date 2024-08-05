<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $first_name;
    public $last_name;
    public $email;
    public $birthday;
    public $passport;
    public $passportPreorder;
    public $brand;
    public $brandPreorder;
    public $insurance;
    public $insurancePreorder;
    public $iko_card;
    public $iko_cardPreorder;
    public $avatar;
    public $avatarPreorder;
    public $weight;
    public $age;
    public $success_politic;
    public $ky;
    public $club;
    public $gender = '?';


    public function toggleGender()
    {
        $this->gender = $this->gender === 'М' ? 'Ж' : 'М';
    }

    public function mount()
    {
        $this->user = Auth::user();

        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->birthday = $this->user->birthday;
        $this->passport = $this->user->passport;
        $this->brand = $this->user->brand;
        $this->insurance = $this->user->insurance;
        $this->iko_card = $this->user->iko_card;
        $this->avatar = $this->user->avatar;
        $this->weight = $this->user->weight;
        $this->age = $this->user->age;
        $this->success_politic = $this->user->success_politic;
        $this->ky = $this->user->ky;
        $this->club = $this->user->club;
        $this->gender = $this->user->gender ?? '?';
    }

    public function update()
    {
//        $this->validate([
//            'first_name' => 'required|string|max:255',
//            'last_name' => 'nullable|string|max:255',
//            'email' => 'required|email|max:255',
//            'club' => 'required|string|max:255',
//            'birthday' => 'nullable|date',
//            'passportPreorder' => 'nullable|image',
//            'brandPreorder' => 'nullable|image',
//            'insurancePreorder' => 'nullable|image',
//            'iko_cardPreorder' => 'nullable|image',
//            'avatarPreorder' => 'nullable|image',
//            'weight' => 'nullable|numeric',
//            'age' => 'nullable|numeric',
//        ]);

        // Обновление свойств
        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        $this->user->email = $this->email;
        $this->user->birthday = $this->birthday;
        $this->user->insurance = $this->insurance;
        $this->user->iko_card = $this->iko_card;
        $this->user->weight = $this->weight;
        $this->user->age = $this->age;
        $this->user->success_politic = $this->success_politic;
        $this->user->ky = $this->ky;
        $this->user->club = $this->club;
        $this->user->gender = $this->gender;

        if ($this->passportPreorder) {
            $this->user->passport = $this->passportPreorder->store('passports', 'public');
        }
        if ($this->brandPreorder) {
            $this->user->brand = $this->brandPreorder->store('brands', 'public');
        }
        if ($this->avatarPreorder) {
            $this->user->avatar = $this->avatarPreorder->store('avatars', 'public');
        }
        if ($this->insurancePreorder) {
            $this->user->insurance = $this->insurancePreorder->store('insurance', 'public');
        }
        if ($this->iko_cardPreorder) {
            $this->user->iko_card = $this->iko_cardPreorder->store('iko_card', 'public');
        }


        $this->user->save();

        $this->dispatch('notify', title: 'Данные сохранены');
    }
    public function render()
    {
        return view('livewire.edit-profile');
    }
}
