<?php

namespace App\Livewire\Forms;

use App\Models\Library;
use App\Models\User;
use App\Enums\LibraryShareRole;
use Livewire\Form;
use Illuminate\Validation\Rule;

class LibraryUpdateShareForm extends Form
{
    public Library $library;
    public User $user;
    public string $role = '';

    public function rules()
    {
        return [
            'role' => [
                'required',
                Rule::enum(LibraryShareRole::class),
                // Cannot change own role
                function ($attribute, $value, $fail) {
                    if ($this->user->id === auth()->id()) {
                        $fail('Vous ne pouvez pas modifier votre propre rôle.');
                    }
                },
            ],
        ];
    }

    public function update()
    {
        $this->validate();

        // Update the user's role in the library
        $this->library->sharedUsers()->updateExistingPivot($this->user->id, [
            'role' => LibraryShareRole::from($this->role),
            'updated_at' => now(),
        ]);
    }
}
