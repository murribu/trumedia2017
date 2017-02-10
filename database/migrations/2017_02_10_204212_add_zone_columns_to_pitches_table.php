<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZoneColumnsToPitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pitches', function (Blueprint $table) {
            $table->integer('r27')->index()->nullable();
            $table->integer('c27')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pitches', function (Blueprint $table) {
            $table->dropIndex('pitches_r27_index');
            $table->dropIndex('pitches_c27_index');
            $table->dropColumn('r27');
            $table->dropColumn('c27');
        });
    }
}
