<?php

use App\Livewire\App\BookIndex;
use App\Livewire\App\LibraryIndex;
use App\Livewire\App\LibraryShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/libraries', LibraryIndex::class)->name('libraries.index');
    Route::get('/libraries/{library}', LibraryShow::class)->name('libraries.show');

    Route::get('/books', BookIndex::class)->name('books.index');

    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
