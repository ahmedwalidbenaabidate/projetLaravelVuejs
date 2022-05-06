<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPersonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_persones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_employee');
            $table->double('presence');
            $table->double('heurs_suppl');
            $table->string('remarque');
            $table->date('date_pointage');
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
        Schema::dropIfExists('p_persones');
    }
}
