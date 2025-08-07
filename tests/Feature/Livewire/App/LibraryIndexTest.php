<?php

use App\Livewire\App\LibraryIndex;
use App\Models\Library;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->assertStatus(200);
});

it('shows libraries for the authenticated user', function () {
    $user = User::factory()->create();
    $library = Library::factory()->for($user)->create();

    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->assertSee($library->name);
});

it('does not show libraries for other users', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $library = Library::factory()->for($otherUser)->create();

    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->assertDontSee($library->name);
});

it('can add a new library', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->set('form.name', 'Test Library')
        ->call('store')
        ->assertHasNoErrors();
});

it('shows validation errors when adding a library without a name', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->set('form.name', '')
        ->call('store')
        ->assertHasErrors(['form.name']);
});

it('can delete a library', function () {
    $user = User::factory()->create();
    $library = Library::factory()->for($user)->create();

    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->call('delete', $library->id)
        ->assertHasNoErrors();

    $this->assertDatabaseMissing('libraries', ['id' => $library->id]);
});

it('can not delete a non authorized library', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $library = Library::factory()->for($otherUser)->create();

    Livewire::actingAs($user)
        ->test(LibraryIndex::class)
        ->call('delete', $library->id)
        ->assertForbidden();
});
