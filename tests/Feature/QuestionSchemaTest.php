<?php

// use App\Filament\Resources\Questions\Pages\CreateQuestion;

use App\Filament\Resources\Questions\Pages\CreateQuestion;
use App\Filament\Resources\Questions\Pages\ListQuestions;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses(Illuminate\Foundation\Testing\DatabaseMigrations::class);


beforeEach(function () {
    $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
    

    actingAs($user);
    
});


test('can load the page', function () {
    $users = User::factory()->count(5)->create();

    livewire(CreateQuestion::class)
        ->assertOk();
        // ->assertCanNotSeeTableRecords($users);
});