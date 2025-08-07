<?php

use App\Livewire\App\BookIndex;
use App\Models\Book;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(BookIndex::class)
        ->assertStatus(200);
});

it('shows books', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create();

    Livewire::actingAs($user)
        ->test(BookIndex::class)
        ->assertSee($book->title);
});
