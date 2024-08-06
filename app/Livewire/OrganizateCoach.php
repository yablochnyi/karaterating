<?php

namespace App\Livewire;

use App\Mail\Invitation;
use App\Models\User;
use App\Models\WaitConfirmationInvitationStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrganizateCoach extends Component
{
    public $coaches;
    public $emails;
    public $waitConfirmStudent;

    public function sendEmails()
    {
        $emails = array_map('trim', explode(',', $this->emails));

        if ($emails) {
            try {
                foreach ($emails as $email) {
                    Mail::to($email)->send(new Invitation(auth()->id(), 'Приглашение от организатора'));

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

    public function deleteEmail($id)
    {
        WaitConfirmationInvitationStudent::find($id)->delete();
        $this->mount();
    }

    public function mount()
    {
        $this->coaches = User::where('organization_id', Auth::id())->get();
        $this->waitConfirmStudent = WaitConfirmationInvitationStudent::where('coach_id', auth()->id())->where('confirmed', false)->get();
    }

    public function deleteCoach($id)
    {
        $coach = User::where('id', $id)->first();
        $coach->organization_id = null;
        $coach->save();

        $this->mount();
    }

    public function render()
    {

        return view('livewire.organizate-coach');
    }
}
