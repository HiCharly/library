<?php

namespace App\Livewire\App;

use App\Models\Library;
use App\Livewire\Forms\LibraryAddShare;
use Livewire\Component;
use Livewire\Attributes\On;

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

    #[On('share-updated')]
    public function shareUpdated(): void
    {
        $this->library->load('sharedUsers');
    }
}
