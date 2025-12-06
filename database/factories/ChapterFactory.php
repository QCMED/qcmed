<?php

namespace Database\Factories;

use App\Models\Matiere;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapters>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $matiere = Matiere::factory()-> create();
        return [
            'numero' => $this->faker->unique()->numberBetween(1000,1500),
            'description' => $this->faker->sentence(),
        ];
    }

    public function configure() 
    {
        return $this -> afterCreating(function() {
            $matiere= Matiere::exists() ? Matiere::inRandomOrder()->first(): Matiere::factory()->create();
            $matiere -> chapters() ->saveMany($this);
        });
    }
}
