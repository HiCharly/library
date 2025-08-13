<?php

namespace App\Livewire\App;

use App\Models\Book;
use App\Models\Library;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class LibraryShow extends Component
{
    public Library $library;

    public string $search = '';

    #[Computed()]
    public function books()
    {
        return $this->library->books()
            ->search($this->search)
            ->get();
    }

    #[On('book-created')]
    public function bookCreated(string $initiator, Book $book)
    {
        if ($initiator !== get_class($this)) {
            return;
        }

        $this->library->books()->attach($book);

        // TODO : book created and added to library notification
    }
}
