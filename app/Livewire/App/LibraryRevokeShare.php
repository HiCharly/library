<?php

namespace App\Livewire\App;

use App\Models\Library;
use App\Models\User;
use Livewire\Component;

class LibraryRevokeShare extends Component
{
    public Library $library;
    public User $user;
    public function mount(Library $library, User $user): void
    {
        $this->library = $library;
        $this->user = $user;
    }

    public function revokeAccess(): void
    {
        $this->authorize('manageShares', $this->library);

        // Revoke user access
        $this->library->sharedUsers()->detach($this->user->id);

        // Close modal using Flux UI
        $this->modal('revoke-share-'.$this->user->id)->close();

        // Refresh the parent component
        $this->dispatch('share-updated');
    }

    public function render()
    {
        return view('livewire.app.library-revoke-share');
    }
}
