<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Routine>
 */
class RoutineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->dateTimeBetween('+1 hour', '+10 hour'),
            'time' => $this->faker->time,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
