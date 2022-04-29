<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QualiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libelleFonction' => $this ->faker->title(),
        ];
    }
}
