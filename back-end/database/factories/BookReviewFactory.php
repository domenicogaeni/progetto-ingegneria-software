<?php

namespace Database\Factories;

use App\Models\BookReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookReview::class;

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
