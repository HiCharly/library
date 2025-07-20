<?php

namespace App\Livewire\App;

use App\Livewire\Forms\BookForm;
use App\Models\Book;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BookIndex extends Component
{
    public BookForm $form;

    #[Computed]
    public function books()
    {
        return Book::all();;
    }

    public function store() {
        
        $this->authorize('create', Book::class);

        $this->form->store();

        $this->modal('create-book')->close();
    }
}
