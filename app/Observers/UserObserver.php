<?php

namespace App\Observers;

use App\Mail\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (empty($user->ref_token)) {
            $user->ref_token = Str::uuid()->toString();
            $user->saveQuietly();  // Используем saveQuietly, чтобы избежать вызова событий
//
//            if ($user->role_id == User::Organization) {
//                Mail::to($user->email)->send(new Invitation($user->id, 'Приглашение'));
//            }
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
