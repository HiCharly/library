<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Enums\LibraryShareRole;

class LibraryForm extends Form
{
    #[Validate('required|min:3|max:255|string')]
    public $name = '';

    public function store()
    {
        $this->validate();

        $library = new \App\Models\Library();
        $library->name = $this->name;
        $library->save();

        // Set creator as owner in shares
        $library->shares()->create([
            'user_id' => Auth::id(),
            'role' => LibraryShareRole::OWNER,
        ]);
    }
}
