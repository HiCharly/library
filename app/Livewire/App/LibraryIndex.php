<?php

namespace App\Livewire\App;

use App\Livewire\Forms\LibraryForm;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LibraryIndex extends Component
{
    public LibraryForm $form;

    #[Computed]
    public function libraries()
    {
        return Library::query()
            ->viewableBy(Auth::user())
            ->get();
    }

    public function store()
    {
        $this->authorize('create', Library::class);

        $this->form->store();

        $this->modal('create-library')->close();
    }

    public function delete(Library $library)
    {
        $this->authorize('delete', $library);

        $library->delete();
    }
}
