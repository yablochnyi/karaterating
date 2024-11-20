<?php

namespace App\Policies;

use App\Models\Agreement;
use App\Models\Organization;
use App\Models\User;

class AgreementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === User::Admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Agreement $agreement): bool
    {
        return $user->role_id === User::Admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === User::Admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Agreement $agreement): bool
    {
        return $user->role_id === User::Admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Agreement $agreement): bool
    {
        return $user->role_id === User::Admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Agreement $agreement): bool
    {
        return $user->role_id === User::Admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Agreement $agreement): bool
    {
        return $user->role_id === User::Admin;
    }
}
