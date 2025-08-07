<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LibraryForm extends Form
{
    #[Validate('required|min:3|max:255|string')]
    public $name = '';

    public function store()
    {
        $this->validate();

        $library = new \App\Models\Library();
        $library->user_id = Auth::id();
        $library->name = $this->name;
        $library->save();
    }
}
