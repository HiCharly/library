<?php

namespace App\Livewire\App;

use App\Models\Library;
use Livewire\Component;

class LibraryManageShares extends Component
{
    public Library $library;

    public function mount(Library $library): void
    {
        $this->library = $library;
    }
}
