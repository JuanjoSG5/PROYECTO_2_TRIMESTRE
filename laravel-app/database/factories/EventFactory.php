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
    public function definition(): array
    {
        $priority = $this->faker->randomElement(['low', 'medium', 'high']);
        $start_date = $this->faker->date;
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'start_date' => $start_date,
            'end_date' => $this->faker->dateTimeBetween($start_date, '+1 hour'),
            'time' => $this->faker->time,
            'priority' => $priority,
            'user_id' => 1,
        ];
    }
}
