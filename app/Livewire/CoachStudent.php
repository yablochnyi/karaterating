<?php

namespace App\Livewire;

use App\Mail\InvitationFromTheCoach;
use App\Models\User;
use App\Models\WaitConfirmationInvitationStudent;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CoachStudent extends Component
{
    public $emails;
    public function deleteStudent($id)
    {
        $student = User::where('id', $id)->first();
        $student->coach_id = 0;
        $student->save();
    }

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

    public function render()
    {
        $students = User::where('coach_id', auth()->id())->get();
        $waitConfirmStudent = WaitConfirmationInvitationStudent::where('coach_id', auth()->id())->where('confirmed', false)->get();
        return view('livewire.coach-student', compact('students', 'waitConfirmStudent'));
    }
}
