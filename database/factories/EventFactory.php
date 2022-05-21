<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invitation;
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

    public function private()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_public' => false,
            ];
        });
    }

    public function public()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_public' => true,
            ];
        });
    }

    public function full() 
    {
        return $this->has(
            Invitation::factory()->count(3)
        )
        ->state(function (array $attributes) {
            return [
                'max_invitations' => 3,
            ];
        });
    }

    public function almostFull() 
    {
        return $this->has(
            Invitation::factory()->count(2)
        )
        ->state(function (array $attributes) {
            return [
                'max_invitations' => 3,
            ];
        });
    }

    public function limited() 
    {
        return $this->state(function (array $attributes) {
            return [
                'max_invitations' => 3,
            ];
        });
    }

    public function unlimited() 
    {
        return $this->state(function (array $attributes) {
            return [
                'max_invitations' => NULL,
            ];
        });
    }
}
