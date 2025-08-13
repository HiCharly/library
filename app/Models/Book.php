<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\Wireable;
use Illuminate\Support\Carbon;

class Book extends Model implements Wireable
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function toLivewire()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'publisher' => $this->publisher,
            'page_count' => $this->page_count,
            'thumbnail_url' => $this->thumbnail_url,
            'published_at' => $this->published_at?->toString(),
            'web_reader_url' => $this->web_reader_url,
            'created_at' => $this->created_at?->toString(),
            'updated_at' => $this->updated_at?->toString(),
        ];
    }

    public static function fromLivewire($data)
    {
        $book = new self();
        $book->id = $data['id'] ?? null;
        $book->title = $data['title'] ?? null;
        $book->author = $data['author'] ?? null;
        $book->isbn = $data['isbn'] ?? null;
        $book->description = $data['description'] ?? null;
        $book->publisher = $data['publisher'] ?? null;
        $book->page_count = $data['page_count'] ?? null;
        $book->published_at = isset($data['published_at']) ? Carbon::parse($data['published_at']) : null;
        $book->thumbnail_url = $data['thumbnail_url'] ?? null;
        $book->web_reader_url = $data['web_reader_url'] ?? null;
        $book->created_at = isset($data['created_at']) ? Carbon::parse($data['created_at']) : null;
        $book->updated_at = isset($data['updated_at']) ? Carbon::parse($data['updated_at']) : null;
        return $book;
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        if(empty($search)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%');
        });
    }
}
