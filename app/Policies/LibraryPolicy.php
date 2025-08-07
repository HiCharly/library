<?php

namespace App\Policies;

use App\Models\Library;
use App\Models\User;

class LibraryPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Library $library): bool
    {
        // Allow users to view their own libraries
        return $library->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Allow any authenticated user to create a library
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Library $library): bool
    {
        // Allow users to update their own libraries
        return $library->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Library $library): bool
    {
        // Allow users to delete their own libraries
        return $library->user_id === $user->id;
    }
}
