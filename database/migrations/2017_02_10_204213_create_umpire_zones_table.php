<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUmpireZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umpire_zones', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('umpire_id')->unsigned();
            $table->foreign('umpire_id')->references('id')->on('umpires');
            $table->integer('zone_c27')->unsigned();
            $table->integer('zone_r27')->unsigned();
            $table->integer('umpire_prob_called_strike')->unsigned();
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
        Schema::dropIfExists('umpire_zones');
    }
}
