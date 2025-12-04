<?php

use App\Filament\Resources\Dossiers\Pages\CreateDossier;
use App\Models\User;
use Database\Seeders\ChaptersSeeder;
use Database\Seeders\LearningObjectivesSeeder;
use Filament\Forms\Components\Repeater;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
    actingAs($user);
    
});

test('can load the dossier create form', function () {

    livewire(CreateDossier::class)
        ->assertOk();
});

test('dossier form has errors', function () {
    livewire(CreateDossier::class)
        ->fillForm([
            'chapter' => "50",
        ])
        ->call("create")
        ->assertHasFormErrors();
});




test('form can create dossier', function() {

    for ($i = 0; $i <= 4; $i++) $LOArray[$i] = fake()->numberBetween(0,4000);  
    //ATTENTION will break when the custom exception about LO-chapter matching in Question Model will be implemented

    for ($i = 0; $i <=4; $i++) $questionFormArray [$i]= [
            'chapter_id' => fake()->numberBetween(0,100),
            'learning_objectives' => $LOArray,
            'type' => 0,
            'body' => fake()->sentence(),
            'proposed_count' => 1,
            'expected_answer' => [
                [
                    "proposition" => fake()->sentence(),
                    "correction" => fake()->sentence(),
                    "vrai" =>1
                ],
                [ 
                    "proposition" => fake()->sentence(),
                    "correction" => fake()->sentence(),
                    "vrai" =>1
                ],
                [
                    "proposition" => fake()->sentence(),
                    "correction" => fake()->sentence(),
                    "vrai" =>1
                ],
                [
                    "proposition" => fake()->sentence(),
                    "correction" => fake()->sentence(),
                    "vrai" =>1
                ],
                [
                    "proposition" => fake()->sentence(),
                    "correction" => fake()->sentence(),
                    "vrai" =>1
                ],
            ]
        ];

    $undoRepeaterFake = Repeater::fake();
    $this->seed([
        ChaptersSeeder::class,
        LearningObjectivesSeeder::class,
    ]);
    livewire(CreateDossier::class)
        ->fillForm([
            'title' => fake()->sentence(),
            'status' => 0, 
            'body' => fake()->sentence(),
            'questions' => $questionFormArray, 
        ])
        ->call("create")
        ->assertHasNoFormErrors();
        $undoRepeaterFake();
});