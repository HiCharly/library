<?php

use App\Livewire\App\BookShow;
use Livewire\Livewire;

it('renders successfully', function () {
    $book = \App\Models\Book::factory()->create();

    Livewire::test(BookShow::class, ['book' => $book])
        ->assertStatus(200);
});
