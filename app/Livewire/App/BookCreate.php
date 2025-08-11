<?php

namespace App\Livewire\App;

use App\Enums\BookCreateMode;
use App\Livewire\Forms\BookForm;
use App\Models\Book;
use App\Services\BooksApi\Google;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BookCreate extends Component
{
    #[Locked]
    public string $initiator;

    public BookForm $form;

    #[Locked]
    public ?BookCreateMode $mode = null;

    public function mount()
    {
        $this->searchTerm = '';
        $this->searchResults = new Collection();
    }

    public function selectMode(?BookCreateMode $mode = null): void
    {
        $this->mode = $mode;
        $this->reset('searchTerm', 'searchResults');
    }

    // ***************************************
    // Scan mode
    // ***************************************
    #[On('book-scanned')]
    public function bookScanned(string $barcode)
    {
        // Go to search mode, with the scanned barcode
        $this->selectMode(BookCreateMode::SEARCH);
        $this->searchTerm = 'isbn:' . $barcode;
        $this->submitSearch();
    }

    // ***************************************
    // Search mode
    // ***************************************
    public string $searchTerm;

    public Collection $searchResults;

    public function submitSearch(): void
    {
        if (empty($this->searchTerm)) {
            $this->reset('searchResults');
        }

        $this->searchResults = Google::getInstance()->search($this->searchTerm);
    }

    public function importBook(int $searchResultOffset): void
    {
        $book = $this->searchResults->offsetGet($searchResultOffset);

        // Prepare data for the form
        $formData = $book->toArray();
        $formData = Arr::except($formData, ['published_at']);
        $formData['published_at'] = $book->published_at?->format('Y-m-d');

        $this->form->fill($formData);
        $this->mode = BookCreateMode::MANUAL;
    }

    // ***************************************
    // Manual mode
    // ***************************************
    public function store()
    {
        $this->authorize('create', Book::class);

        $book = $this->form->store();

        $this->modal('create-book')->close();

        $this->dispatch('book-created', initiator: $this->initiator, book: $book->id);
    }
}
