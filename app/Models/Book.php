<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\Wireable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements Wireable, HasMedia
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'publisher',
        'published_at',
        'thumbnail_url',
        'page_count',
        'web_reader_url',
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
        return $data['id'] ? Book::find($data['id']) : new Book()->fill($data);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%');
        });
    }

    public function getCoverUrl(): ?string
    {
        $media = $this->getMedia('cover');
        if($media->isNotEmpty()) {
            return $media->first()->getUrl();
        }
        else {
            return $this->thumbnail_url;
        }
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->singleFile();
    }
}
