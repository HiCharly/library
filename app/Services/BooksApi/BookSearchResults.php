<?php

namespace App\Services\BooksApi;

use Illuminate\Support\Collection;

class BookSearchResults
{
    public Collection $items;
    public int $total;
    public int $maxResults;
    public int $startIndex;
    public bool $hasMore;

    public function __construct(Collection $items, int $total, int $maxResults, int $startIndex)
    {
        $this->items = $items;
        $this->total = $total;
        $this->maxResults = $maxResults;
        $this->startIndex = $startIndex;
        $this->hasMore = ($startIndex + $maxResults) < $total;
    }
}
