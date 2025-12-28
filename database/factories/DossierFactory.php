<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dossier>
 */
class DossierFactory extends Factory
{
    /**
     * Create dossiers without auto-creating questions.
     */
    protected bool $withQuestions = false;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'status' => 0,
            'author_id' => User::factory(),
        ];
    }

    /**
     * Create dossier with auto-generated questions.
     */
    public function withQuestions(int $count = 5): static
    {
        return $this->afterCreating(function ($dossier) use ($count) {
            $questions = Question::factory()->count($count)->create();
            $dossier->questions()->saveMany($questions);
        });
    }
}
