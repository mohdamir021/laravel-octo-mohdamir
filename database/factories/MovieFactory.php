<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'release' => $this->faker->date,
            'length' => 90,
            'description' => $this->faker->sentence,
            'mpaa_rating' => rand(1,10),
            'genre'=> "Untitled",
            'director' => $this->faker->name,
            'performer' => $this->faker->name,
            'language' => "English"
        ];
    }
}
