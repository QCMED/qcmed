<?php

// use App\Filament\Resources\Questions\Pages\CreateQuestion;

use App\Filament\Resources\Questions\Pages\CreateQuestion;
use App\Filament\Resources\Questions\Pages\EditQuestion;
use App\Filament\Resources\Questions\Pages\ListQuestions;
use App\Models\User;
use Database\Seeders\ChaptersSeeder;
use Database\Seeders\ChaptersSeederComplete;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);


beforeEach(function () {
    $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
    actingAs($user);
});


test('can load the question create form', function () {

    livewire(CreateQuestion::class)
        ->assertOk();
});

// test('can load the question edit form', function () {

//     livewire(EditQuestion::class)
//         ->assertOk();
// });

test('form has errors', function () {
    $this->seed(ChaptersSeeder::class);
    livewire(CreateQuestion::class)
        ->fillForm([
            // 'title' => fake()->sentence(),
            'chapter' => "50",
        ])
        ->call("create")
        ->assertHasFormErrors();
});