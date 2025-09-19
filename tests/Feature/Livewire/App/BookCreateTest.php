<?php

use App\Livewire\App\BookCreate;
use App\Models\User;
use App\Models\Library;
use App\Enums\LibraryShareRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    $owner = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    Livewire::actingAs($owner)
        ->test(BookCreate::class, [
            'initiator' => get_class($this),
            'library' => $library
        ])
        ->assertStatus(200);
});

it('can add a new book manually', function () {
    $owner = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    Livewire::actingAs($owner)
        ->test(BookCreate::class, [
            'initiator' => get_class($this),
            'library' => $library
        ])
        ->set('form.title', 'Test Book')
        ->call('store')
        ->assertHasNoErrors();
});

it('shows validation errors when adding a book without a title', function () {
    $owner = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    Livewire::actingAs($owner)
        ->test(BookCreate::class, [
            'initiator' => get_class($this),
            'library' => $library
        ])
        ->set('form.title', '')
        ->call('store')
        ->assertHasErrors(['form.title']);
});

it('denies access to non-authorized user', function () {
    $viewer = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $viewer->id,
        'role' => LibraryShareRole::VIEWER,
    ]);

    Livewire::actingAs($viewer)
        ->test(BookCreate::class, [
            'initiator' => get_class($this),
            'library' => $library
        ])
        ->set('form.title', 'Test Book')
        ->call('store')
        ->assertForbidden();
});
