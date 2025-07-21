<?php

use App\Livewire\App\BookCard;
use Livewire\Livewire;

it('renders successfully', function () {
    $book = \App\Models\Book::factory()->create();

    Livewire::test(BookCard::class, ['book' => $book])
        ->assertStatus(200);
});

it('displays the book title', function () {
    $book = \App\Models\Book::factory()->create(['title' => 'Test Book']);

    Livewire::test(BookCard::class, ['book' => $book])
        ->assertSee('Test Book');
});