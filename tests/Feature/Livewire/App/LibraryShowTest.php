<?php

use App\Livewire\App\LibraryShow;
use App\Models\Library;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    $user = User::factory()->create();
    $library = Library::factory()->create();

    Livewire::actingAs($user)
        ->test(LibraryShow::class, ['library' => $library])
        ->assertStatus(200);
});

it('loads the library data', function () {
    $user = User::factory()->create();
    $library = Library::factory()->create();

    Livewire::actingAs($user)
        ->test(LibraryShow::class, ['library' => $library])
        ->assertSet('library', $library);
});

it('displays the library name', function () {
    $user = User::factory()->create();
    $library = Library::factory()->create(['name' => 'Test Library']);

    Livewire::actingAs($user)
        ->test(LibraryShow::class, ['library' => $library])
        ->assertSee('Test Library');
});