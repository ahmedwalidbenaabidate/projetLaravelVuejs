<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeMaterielFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libelleMateriel' => $this ->faker->title(),
            'photo' => $this ->faker->Avatar.image(),
        ];
    }
}
