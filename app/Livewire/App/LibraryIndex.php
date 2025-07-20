<?php

namespace App\Livewire\App;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LibraryIndex extends Component
{
    #[Computed]
    public function libraries()
    {
        return Auth::user()->libraries;
    }
}
