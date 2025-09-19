<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\LibraryShareRole;

class LibraryShare extends Pivot
{
    protected $table = 'library_share';

    protected $fillable = [
        'library_id',
        'user_id',
        'role',
    ];

    protected function casts(): array
    {
        return [
            'role' => LibraryShareRole::class,
        ];
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
