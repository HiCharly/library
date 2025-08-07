<?php

namespace App\Livewire\Forms;

use App\Models\Book;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BookForm extends Form
{
    #[Validate('required|max:255|string')]
    public string $title = '';

    #[Validate('nullable|max:255|string')]
    public ?string $author = null;

    #[Validate('nullable|string')]
    public ?string $isbn = null;

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('nullable|max:255|string')]
    public ?string $publisher = null;

    #[Validate('nullable|date')]
    public ?string $published_at = null;

    #[Validate('nullable|integer|min:1')]
    public ?int $page_count = null;

    public function store()
    {
        $this->validate();

        // Check if the book already exists
        $existingBook = Book::where('isbn', $this->isbn)->first();
        if ($existingBook) {
            return $existingBook;
        }

        $book = new Book();
        $book->title = $this->title;
        $book->author = $this->author;
        $book->isbn = $this->isbn;
        $book->description = $this->description;
        $book->publisher = $this->publisher;
        $book->published_at = $this->published_at;
        $book->page_count = $this->page_count;
        $book->save();

        return $book;
    }
}
