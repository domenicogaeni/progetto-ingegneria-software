<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'isbn' => $this->faker->isbn13(),
            'authors' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->text,
            'gender' => $this->faker->text,
        ];
    }
}
