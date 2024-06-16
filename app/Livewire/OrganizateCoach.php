<?php

namespace App\Livewire;

use App\Mail\InvitationFromTheCoach;
use App\Models\User;
use App\Models\WaitConfirmationInvitationStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrganizateCoach extends Component
{
    public $coaches;
    public $emails;

    public function sendEmails()
    {
        $emails = array_map('trim', explode(',', $this->emails));

        if ($emails) {
            try {
                foreach ($emails as $email) {
                    Mail::to($email)->send(new InvitationFromTheCoach(auth()->id()));

                    WaitConfirmationInvitationStudent::create([
                        'coach_id' => auth()->id(),
                        'email' => $email,
                    ]);
                }
            } catch (\Exception $e) {

            }
        }


        $this->emails = '';
    }

    public function mount()
    {
        $this->coaches = User::where('organization_id', Auth::id())->get();
    }

    public function deleteCoach($id)
    {
        $coach = User::where('id', $id)->first();
        $coach->organization_id = 0;
        $coach->save();
    }

    public function render()
    {
        $waitConfirmStudent = WaitConfirmationInvitationStudent::where('coach_id', auth()->id())->where('confirmed', false)->get();
        return view('livewire.organizate-coach', compact('waitConfirmStudent'));
    }
}
