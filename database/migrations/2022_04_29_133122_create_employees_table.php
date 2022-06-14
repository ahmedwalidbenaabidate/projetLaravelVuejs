<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('referencee');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('tele');
            $table->string('cin');
            $table->double('salaire');
            $table->string('type_salaire');
            $table->date('permisDate');
            $table->integer('qualite_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
