<?php

namespace Database\Factories;

use App\Models\Commerce;
use App\Models\CurrentQueue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommerceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commerce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Pizzeria Local',
            'latitude' => $this->faker->randomFloat(null,0,7),
            'longitude' => $this->faker->randomFloat(null,0,7),
            'user_id'=> User::factory()->admin()->create(),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Commerce $commerce) {
            CurrentQueue::factory()->create([
                'commerce_id' => $commerce->id,
            ]);
        });
    }
}
