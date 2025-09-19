<?php

namespace App\Livewire\Forms;

use App\Models\Library;
use App\Models\User;
use App\Enums\LibraryShareRole;
use Livewire\Form;
use Illuminate\Validation\Rule;

class LibraryAddShare extends Form
{
    public Library $library;

    public string $email = '';

    public string $role = '';

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
                Rule::unique('library_share', 'user_id')
                    ->where('library_id', $this->library->id)
            ],
            'role' => [
                'required',
                Rule::enum(LibraryShareRole::class)
            ],
        ];
    }

    public function store()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        $this->library->sharedUsers()->attach($user->id, [
            'role' => LibraryShareRole::from($this->role),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
