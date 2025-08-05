<?php

namespace App\Livewire\App;

use App\Livewire\Forms\BookForm;
use App\Models\Book;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class BookIndex extends Component
{
    public BookForm $form;

    #[Computed]
    public function books()
    {
        return Book::all();;
    }

    #[On('book-created')]
    public function bookCreated(string $initiator, Book $book) {
        if($initiator !== get_class($this)) {
            return;
        }

        // TODO : book created notification
    }
}
