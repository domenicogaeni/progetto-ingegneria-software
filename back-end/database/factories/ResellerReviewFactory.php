<?php

namespace Database\Factories;

use App\Models\ResellerReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResellerReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResellerReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text,
            'vote' => $this->faker->numberBetween(1, 5),
        ];
    }
}
