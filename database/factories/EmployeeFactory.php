<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference' => $this ->faker->ean8(),
            'nom' => $this ->faker->name(),
            'prenom' => $this ->faker->name(),
            'adresse' => $this ->faker->address(),
            'cin' => $this ->faker->ean8(),
            'salaire' => $this ->faker->ean8(),
            'type_salaire' => $this ->faker->title(),
            'permisDate' => $this ->faker->Date(),
            'qualite_id' => $this ->faker->ean8(),
        ];
    }
}
