<?php

namespace App\Services\BooksApi;

use App\Models\Book;
use Illuminate\Support\Collection;
use Livewire\Wireable;

class BookSearchResults implements Wireable
{
    public Collection $items;
    public int $total;
    public int $perPage;
    public int $offset;
    public bool $hasMore;

    public function __construct(Collection $items, int $total, int $perPage, int $offset)
    {
        $this->items = $items;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->offset = $offset;
        $this->hasMore = ($offset + $perPage) < $total;
    }

    public function toLivewire(): array
    {
        return [
            'items' => $this->items->map(fn($item) => $item->toLivewire())->all(),
            'total' => $this->total,
            'perPage' => $this->perPage,
            'offset' => $this->offset,
            'hasMore' => $this->hasMore,
        ];
    }

    public static function fromLivewire($data)
    {
        return new self(
            collect($data['items'])->map(fn($item) => Book::fromLivewire($item)),
            $data['total'],
            $data['perPage'],
            $data['offset'],
        );
    }
}
