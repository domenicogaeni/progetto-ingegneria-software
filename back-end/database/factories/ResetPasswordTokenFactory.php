<?php

namespace Database\Factories;

use App\Models\ResetPasswordToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResetPasswordTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResetPasswordToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
            'token' => $this->faker->uuid,            
            'expired_at' => $this->faker->dateTimeBetween('now', '+1 hours'),
        ];
    }
}
