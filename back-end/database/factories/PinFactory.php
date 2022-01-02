<?php

namespace Database\Factories;

use App\Models\Pin;
use Illuminate\Database\Eloquent\Factories\Factory;

class PinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pin' => $this->faker->randomNumber(6),
            'expired_at' => $this->faker->dateTimeBetween('now', '+5 minutes'),
        ];
    }
}
