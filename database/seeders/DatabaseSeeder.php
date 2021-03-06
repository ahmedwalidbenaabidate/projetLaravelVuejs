<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Chantier::factory(15)->create();
        \App\Models\Qualite::factory(8)->create();
        \App\Models\Employee::factory(6)->create();
        \App\Models\TypeMateriel::factory(6)->create();
    }
}
