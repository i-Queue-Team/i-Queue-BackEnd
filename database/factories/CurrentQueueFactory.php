<?php

namespace Database\Factories;

use App\Models\CurrentQueue;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrentQueueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurrentQueue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fixed_capacity' => $this->faker->numberBetween(10,50),
            'average_time' => $this->faker->numberBetween(5,10),
            'password_verification' => '12345',
            'commerce_id' => 'overriden',
        ];
    }
}
