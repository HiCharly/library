<?php

namespace App\Livewire\App;

use App\Livewire\Forms\LibraryForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LibraryIndex extends Component
{
    public LibraryForm $form;

    #[Computed]
    public function libraries()
    {
        return Auth::user()->libraries;
    }
    
    public function store()
    {
        $this->form->store();

        $this->modal('create-library')->close();
    }
}
