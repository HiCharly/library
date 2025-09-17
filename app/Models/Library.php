<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\LibraryShareRole;
use Illuminate\Database\Eloquent\Attributes\Scope;

class Library extends Model
{
    use HasFactory;

    /**
     * Get the books in the library.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_library')
            ->withTimestamps();
    }

    /**
     * Determine if a given user is owner of the library.
     */
    public function isOwnedBy(User $user): bool
    {
        return $this->shares()
            ->where('user_id', $user->id)
            ->where('role', LibraryShareRole::Owner)
            ->exists();
    }

    /**
     * Shares of the library.
     */
    public function shares(): HasMany
    {
        return $this->hasMany(LibraryShare::class);
    }

    /**
     * Users with whom the library is shared.
     */
    public function sharedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'library_shares')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Scope libraries the given user can view.
     */
    #[Scope]
    public function viewableBy(Builder $query, User $user): Builder
    {
        return $query->whereHas('shares', fn ($q) => $q->where('user_id', $user->id));
    }

    /**
     * Scope libraries the given user can edit.
     */
    #[Scope]
    public function editableBy(Builder $query, User $user): Builder
    {
        return $query->whereHas(
            'shares',
            fn ($q) => $q->where('user_id', $user->id)
            ->whereIn('role', [LibraryShareRole::Owner, LibraryShareRole::Editor])
        );
    }
}
