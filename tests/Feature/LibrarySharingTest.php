<?php

use App\Models\Library;
use App\Enums\LibraryShareRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows viewer to view but not edit', function () {
    $owner = User::factory()->create();
    $viewer = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    $library->shares()->create([
        'user_id' => $viewer->id,
        'role' => LibraryShareRole::VIEWER,
    ]);

    $policy = app(\App\Policies\LibraryPolicy::class);
    expect($policy->view($viewer, $library))->toBeTrue();
    expect($policy->update($viewer, $library))->toBeFalse();
});

it('allows editor to view and edit', function () {
    $owner = User::factory()->create();
    $editor = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    $library->shares()->create([
        'user_id' => $editor->id,
        'role' => LibraryShareRole::EDITOR,
    ]);

    $policy = app(\App\Policies\LibraryPolicy::class);
    expect($policy->view($editor, $library))->toBeTrue();
    expect($policy->update($editor, $library))->toBeTrue();
});

it('owner can view and edit and delete', function () {
    $owner = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    $policy = app(\App\Policies\LibraryPolicy::class);
    expect($policy->view($owner, $library))->toBeTrue();
    expect($policy->update($owner, $library))->toBeTrue();
    expect($policy->delete($owner, $library))->toBeTrue();
});

it('policy denies update to viewer', function () {
    $owner = User::factory()->create();
    $viewer = User::factory()->create();
    $library = Library::factory()->create();
    $library->shares()->create([
        'user_id' => $owner->id,
        'role' => LibraryShareRole::OWNER,
    ]);

    $library->shares()->create([
        'user_id' => $viewer->id,
        'role' => LibraryShareRole::VIEWER,
    ]);

    $policy = app(\App\Policies\LibraryPolicy::class);
    expect($policy->update($viewer, $library))->toBeFalse();
});
