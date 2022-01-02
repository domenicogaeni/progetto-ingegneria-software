<?php

namespace Database\Factories;

use App\Models\CreditMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreditMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
            'iban' => $this->faker->iban(),            
        ];
    }
}
