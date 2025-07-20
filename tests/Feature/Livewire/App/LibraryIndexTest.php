<?php

use App\Livewire\App\LibraryIndex;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(LibraryIndex::class)
        ->assertStatus(200);
});
