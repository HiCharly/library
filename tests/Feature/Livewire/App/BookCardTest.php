<?php

use App\Livewire\App\BookCard;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(BookCard::class)
        ->assertStatus(200);
});
