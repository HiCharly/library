<?php

namespace App\Policies;

use App\Models\Library;
use App\Models\User;
use App\Enums\LibraryShareRole;

class LibraryPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Library $library): bool
    {
        return Library::query()
            ->viewableBy($user)
            ->whereKey($library->getKey())
            ->exists();
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
        return Library::query()
            ->editableBy($user)
            ->whereKey($library->getKey())
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Library $library): bool
    {
        // Only owner can delete
        return $library->shares()
            ->where('user_id', $user->id)
            ->where('role', LibraryShareRole::OWNER)
            ->exists();
    }

    /**
     * Determine whether the user can manage shares of the library.
     */
    public function manageShares(User $user, Library $library): bool
    {
        // Only owner can manage shares
        return $library->shares()
            ->where('user_id', $user->id)
            ->where('role', LibraryShareRole::OWNER)
            ->exists();
    }
}
