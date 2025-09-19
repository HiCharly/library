<?php

namespace App\Livewire\App;

use App\Models\Library;
use App\Livewire\Forms\LibraryAddShare;
use Livewire\Component;

class LibraryManageShares extends Component
{
    public Library $library;
    public LibraryAddShare $form;

    public function mount(Library $library): void
    {
        $this->library = $library;
        $this->form->library = $library;
    }

    public function addShare(): void
    {
        $this->authorize('manageShares', $this->library);

        $this->form->store();

        $this->form->reset();

        $this->library->load('sharedUsers');
    }
}
