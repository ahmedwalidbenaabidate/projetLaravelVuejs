<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChantierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this ->faker->ean8(),
            'libelle' => $this ->faker->name(),
            'abreviation' => $this ->faker->title()
        ];
    }
}
