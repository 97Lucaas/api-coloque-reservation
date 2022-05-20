<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'max_invitations' => $this->faker->randomElement([0, 1, 2, 10, NULL]),
            'is_public' => $this->faker->randomElement([true, false]),
            'slug' => $this->faker->slug()
        ];
    }
}
