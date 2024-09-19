<?php

namespace App\Policies;

use App\Models\TemplateStudentList;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TemplateStudentListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === User::Organization;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TemplateStudentList $templateStudentList): bool
    {
        return $user->role_id === User::Organization;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === User::Organization;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TemplateStudentList $templateStudentList): bool
    {
        return $user->role_id === User::Organization && $templateStudentList->user_id === Auth::id();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TemplateStudentList $templateStudentList): bool
    {
        return $user->role_id === User::Organization && $templateStudentList->user_id === Auth::id();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TemplateStudentList $templateStudentList): bool
    {
        return $user->role_id === User::Organization && $templateStudentList->user_id === Auth::id();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TemplateStudentList $templateStudentList): bool
    {
        return $user->role_id === User::Organization && $templateStudentList->user_id === Auth::id();
    }
}
