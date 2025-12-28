<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attempt>
 */
class AttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isCorrect = fake()->boolean();

        return [
            'question_id' => Question::exists() ? Question::inRandomOrder()->first()->id : Question::factory(),
            'user_id' => User::exists() ? User::inRandomOrder()->first()->id : User::factory(),
            'answers' => [fake()->numberBetween(0, 4)],
            'score' => $isCorrect ? 100 : 0,
            'is_correct' => $isCorrect,
        ];
    }
}
