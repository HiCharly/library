<?php

namespace App\Livewire\App;

use App\Livewire\Forms\BookForm;
use App\Models\Book;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BookEdit extends Component
{
    use WithFileUploads;

    public BookForm $form;

    public Book $book;

    public function mount(Book $book): void
    {
        $this->book = $book;

        $this->form->fill($book->toArray());
    }

    public function update()
    {
        $this->authorize('update', $this->book);

        $this->form->validate();

        $this->book->fill($this->form->except(['cover']));

        if ($this->form->cover) {
            $this->book
                ->addMedia($this->form->cover->getRealPath())
                ->toMediaCollection('cover');
        }

        $this->book->save();

        $this->dispatch('book-updated', book: $this->book->id);
    }
}
