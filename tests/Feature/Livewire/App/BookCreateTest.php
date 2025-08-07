<?php

use App\Livewire\App\BookCreate;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(BookCreate::class)
        ->assertStatus(200);
});


it('can add a new book manually', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(BookCreate::class, ['initiator' => get_class($this)])
        ->set('form.title', 'Test Book')
        ->call('store')
        ->assertHasNoErrors();
});

it('shows validation errors when adding a book without a title', function () {
    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(BookCreate::class, ['initiator' => get_class($this)])
        ->set('form.title', '')
        ->call('store')
        ->assertHasErrors(['form.title']);
});
