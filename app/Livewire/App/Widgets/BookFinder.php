<?php

namespace App\Livewire\App\Widgets;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BookFinder extends Component
{
    public ?Collection $searchResults = null;

    #[On('book-scanned')]
    public function bookScanned(string $barcode)
    {
        $this->searchResults = Auth::user()->books()
            ->where('isbn', $barcode)
            ->get();
    }

    public function cancel()
    {
        $this->reset('searchResults');
        $this->modal('book-finder')->close();
        $this->dispatch('book-finder-stop-scan');
    }

    public function again()
    {
        $this->reset('searchResults');
        $this->dispatch('book-finder-start-scan');
    }
}
