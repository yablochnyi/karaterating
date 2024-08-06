<?php

namespace App\Livewire;

use App\Mail\Invitation;
use App\Models\User;
use App\Models\WaitConfirmationInvitationStudent;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CoachStudent extends Component
{
    public $emails;
    public $students;
    public $waitConfirmStudent;
    public function deleteStudent($id)
    {
        $student = User::where('id', $id)->first();
        $student->coach_id = null;
        $student->save();

        $this->mount();
    }

    public function sendEmails()
    {
        $emails = array_map('trim', explode(',', $this->emails));

        if ($emails) {
            try {
                foreach ($emails as $email) {
                    Mail::to($email)->send(new Invitation(auth()->id(), 'Приглашение от тренера'));

                    WaitConfirmationInvitationStudent::create([
                        'coach_id' => auth()->id(),
                        'email' => $email,
                    ]);
                }
            } catch (\Exception $e) {

            }
        }


        $this->emails = '';
        $this->mount();
    }

    public function deleteEmail($id)
    {
        WaitConfirmationInvitationStudent::find($id)->delete();
        $this->mount();
    }

    public function mount()
    {
        $this->students = User::where('coach_id', auth()->id())->get();
        $this->waitConfirmStudent = WaitConfirmationInvitationStudent::where('coach_id', auth()->id())->where('confirmed', false)->get();
    }
    public function render()
    {
        return view('livewire.coach-student');
    }
}
