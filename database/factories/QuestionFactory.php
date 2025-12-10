<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        for ($i = 0; $i < 5; $i++) {
            $expected_answer_array[$i] =
                    [
                        'proposition' => fake()->sentence(),
                        'correction' => fake()->sentence(),
                        'vrai' => 1,
                    ];
        }

        $json = json_encode($expected_answer_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); 
        //Bon ça ne marche PAS dans le json tous les " sont précédés par un \ et ça casse tout dans les pages edit
        //A fix sans urgences

        return [
            'user_id' => User::exists() ? User::inRandomOrder()->first() : User::factory(),
            'chapter_id' => Chapter::exists() ? Chapter::inRandomOrder()->first() : Chapter::factory(),
            'type' => 0,
            'proposed_count' => fake()->boolean(),
            'body' => fake()->paragraph(),
            'expected_answer' => $json,
            'status' => 0,
        ];
    }
}
