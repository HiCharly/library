<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the libraries associated with the user.
     */
    public function libraries()
    {
        return $this->hasMany(Library::class);
    }

    public function books()
    {
        return $this->hasManyDeep(
            Book::class, // Final related model we want to reach
            [
                Library::class, // First intermediate model: User -> Library
                'book_library'  // Second intermediate: pivot table Library -> Book
            ],
            [
                'user_id',     // Foreign key on libraries table pointing to users.id
                'library_id',  // Foreign key on book_library pointing to libraries.id
                'id'           // Local key on books table
            ],
            [
                'id',          // Local key on users table
                'id',          // Local key on libraries table
                'book_id'      // Foreign key on book_library pointing to books.id
            ]
        );
    }
}
