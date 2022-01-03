<?php

namespace Database\Factories;

use App\Models\UserAuthToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAuthTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAuthToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'auth_token' => $this->faker->uuid,
            'expired_at' => $this->faker->dateTimeBetween('now', '+1 days'),
        ];
    }
}
