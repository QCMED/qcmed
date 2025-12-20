<?php

// use App\Filament\Resources\Questions\Pages\CreateQuestion;

use App\Filament\Resources\Chapters\Pages\CreateChapters;
use App\Filament\Resources\Questions\Pages\CreateQuestion;
use App\Models\Chapter;
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

test('can load the chapter create form', function () {

    livewire(CreateChapters::class)
        ->assertOk();
});

test('chapter form has errors', function () {
    livewire(CreateChapters::class)
        ->fillForm([
            'chapter' => '50',
        ])
        ->call('create')
        ->assertHasFormErrors();
});

test('form can create chapter', function () {

    $undoRepeaterFake = Repeater::fake();

    livewire(CreateChapters::class)
        ->fillForm([
            'numero' => fake()->unique()->randomNumber(5, TRUE),
            'description' => fake()->sentence(),
            'learningObjectives' =>[
                [
                    'rang' => fake()->randomElement(["A", "B"]),
                    'rubrique' => fake()->randomElement([
                            "Définition" => "Définition",
                            "Prise En Charge" => "Prise En Charge",
                            "Evaluation" => "Evaluation",
                            "Epidémiologie" => "Epidémiologie",
                            "Physiopathologie" => "Physiopathologie",
                            "Diagnostic Positif" => "Diagnostic Positif",
                            "Suivi et/ou pronostic" => "Suivi et/ou pronostic",
                            "Identifier une urgence" => "Identifier une urgence",
                            "Contenu multimédia" => "Contenu multimédia",
                            "Étiologies" => "Étiologies",
                            "Examens complémentaires" => "Examens complémentaires"
                        ]),
                    'intitule' => fake()->sentence(),
                ],
                [
                    'rang' => fake()->randomElement(["A", "B"]),
                    'rubrique' => fake()->randomElement([
                            "Définition" => "Définition",
                            "Prise En Charge" => "Prise En Charge",
                            "Evaluation" => "Evaluation",
                            "Epidémiologie" => "Epidémiologie",
                            "Physiopathologie" => "Physiopathologie",
                            "Diagnostic Positif" => "Diagnostic Positif",
                            "Suivi et/ou pronostic" => "Suivi et/ou pronostic",
                            "Identifier une urgence" => "Identifier une urgence",
                            "Contenu multimédia" => "Contenu multimédia",
                            "Étiologies" => "Étiologies",
                            "Examens complémentaires" => "Examens complémentaires"
                        ]),
                    'intitule' => fake()->sentence(),
                ],
                
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();
    $undoRepeaterFake();
});


test('Chapter form has required errors', function () {
    $undoRepeaterFake = Repeater::fake();
    livewire(CreateChapters::class)
        ->fillForm([
            'learningObjectives' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'numero' => 'required',
            'description' => 'required',
            'learningObjectives' => 'required',
        ]);
    $undoRepeaterFake();

});
