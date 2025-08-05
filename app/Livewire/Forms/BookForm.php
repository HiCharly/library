<?php

namespace App\Livewire\Forms;

use App\Models\Book;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BookForm extends Form
{
    #[Validate('required|max:255|string')]
    public $title = '';

    #[Validate('nullable|max:255|string')]
    public $author = '';

    #[Validate('nullable|string')]
    public $isbn = '';

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('nullable|max:255|string')]
    public $publisher = '';

    #[Validate('nullable|date')]
    public $published_at = null;

    #[Validate('nullable|integer|min:1')]
    public $page_count = null;

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
