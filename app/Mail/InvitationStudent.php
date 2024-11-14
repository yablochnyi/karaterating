<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $email;
    /**
     * Create a new message instance.
     */
    public function __construct($userId, $email, $subject)
    {
        $this->user = User::find($userId);
        $this->subject = $subject;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $existStudent = User::where('email', $this->email)->first();
        if ($existStudent && $existStudent->coach_id == null) {
            return new Content(
                view: 'mail.re-invitation-student',
            );
        } else {
            return new Content(
                view: 'mail.invitation-student',
            );
        }

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
