<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "last_name" => $this->faker->lastName,
            "dni" => '1717236438',
            "age" => $this->faker->numberBetween(10, 50),
            "gender" => $this->faker->boolean(50) ? 'male' : 'female',
        ];
    }
}
