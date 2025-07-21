<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the library.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the books in the library.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_user_library')
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
