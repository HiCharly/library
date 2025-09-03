<?php

namespace App\Livewire\Forms;

use App\Models\Book;
use App\Rules\MaxFileSize;
use Illuminate\Http\UploadedFile;
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

    #[Validate('nullable|string')]
    public ?string $thumbnail_url = null;

    #[Validate(['nullable', 'image', 'mimes:jpeg,png,jpg', new MaxFileSize()])]
    public ?UploadedFile $cover = null;

    #[Validate('nullable|integer|min:1')]
    public ?int $page_count = null;

    #[Validate('nullable|string')]
    public ?string $web_reader_url = null;

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
        $book->thumbnail_url = $this->thumbnail_url;
        $book->page_count = $this->page_count;
        $book->web_reader_url = $this->web_reader_url;

        if($this->cover) {
            $book->addMedia($this->cover)->toMediaCollection('cover');
        }

        $book->save();

        return $book;
    }

    public function update(Book $book)
    {
        $this->validate();

        $book->title = $this->title;
        $book->author = $this->author;
        $book->isbn = $this->isbn;
        $book->description = $this->description;
        $book->publisher = $this->publisher;
        $book->published_at = $this->published_at;
        $book->thumbnail_url = $this->thumbnail_url;
        $book->page_count = $this->page_count;
        $book->web_reader_url = $this->web_reader_url;
        $book->save();

        if($this->cover) {
            $book->addMedia($this->cover)->toMediaCollection('cover');
        }

        return $book;
    }
}
