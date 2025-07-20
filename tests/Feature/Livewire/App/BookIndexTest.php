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

it('can add a new book manually', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(BookIndex::class)
        ->set('form.title', 'Test Book')
        ->call('store')
        ->assertHasNoErrors();
});

it('shows validation errors when adding a book without a title', function () {
    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(BookIndex::class)
        ->set('form.title', '')
        ->call('store')
        ->assertHasErrors(['form.title']);
});