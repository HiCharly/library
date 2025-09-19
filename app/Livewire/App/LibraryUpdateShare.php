<?php

namespace App\Livewire\App;

use App\Models\Library;
use App\Models\User;
use App\Livewire\Forms\LibraryUpdateShareForm;
use Livewire\Component;

class LibraryUpdateShare extends Component
{
    public Library $library;
    public User $user;
    public LibraryUpdateShareForm $form;

    public function mount(Library $library, User $user): void
    {
        $this->library = $library;
        $this->user = $user;
        $this->form->library = $library;
        $this->form->user = $user;

        // Set current role
        $currentRole = $library->sharedUsers()
            ->where('user_id', $user->id)
            ->first()
            ->pivot
            ->role;
        $this->form->role = $currentRole->value;
    }

    public function updateRole(): void
    {
        $this->authorize('manageShares', $this->library);

        $this->form->update();

        // Close modal using Flux native method
        $this->modal('edit-share-'.$this->user->id)->close();

        // Refresh the parent component
        $this->dispatch('share-updated');
    }

}
