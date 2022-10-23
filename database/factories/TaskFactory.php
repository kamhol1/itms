<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        return [
            'title' => $this->faker->sentence(8),
            'description' => $this->faker->sentence(20),
            'customer_id' => Customer::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'status' => $this->faker->randomElement(['assigned', 'in progress', 'pending', 'closed']),
            'assignee_id' => User::all()->random()->id,
            'due_date' => $this->faker->date()
        ];
    }
}
