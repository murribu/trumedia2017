<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function(Blueprint $table){
            $table->increments('id');
            $table->integer('mlb_id')->unsigned()->unique();
            $table->string('name');
            $table->string('batter_hand',1)->index()->nullable();
            $table->string('pitcher_hand',1)->index()->nullable();
            $table->timestamps();
        });
        Schema::create('pitch_results', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug', 20)->unique();
            $table->string('description');
            $table->boolean('ball');
            $table->boolean('strike');
            $table->timestamps();
        });
        Schema::create('pitch_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug', 20)->unique();
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('plate_appearance_results', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug', 20)->unique();
            $table->string('description');
            $table->boolean('atbat');
            $table->boolean('hit');
            $table->boolean('onbase');
            $table->smallInteger('bases');
            $table->timestamps();
        });
        Schema::create('batted_ball_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug', 20)->unique();
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('pitches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('raw_data_id')->unsigned();
            $table->foreign('raw_data_id')->references('id')->on('raw_data');
            $table->integer('season_year')->index();
            $table->string('game_string', 50)->index();
            $table->datetime('game_date')->index();
            $table->string('game_type', 20)->index();
            $table->string('visitor',10)->index();
            $table->string('home',10)->index();
            $table->integer('visiting_team_final_runs');
            $table->integer('home_team_final_runs');
            $table->integer('inning')->index();
            $table->string('side',1)->index();
            $table->integer('batter_id')->unsigned();
            $table->foreign('batter_id')->references('id')->on('players');
            $table->string('batter_hand', 1)->index();
            $table->integer('pitcher_id')->unsigned();
            $table->foreign('pitcher_id')->references('id')->on('players');
            $table->string('pitcher_hand', 1)->index();
            $table->integer('catcher_id')->unsigned();
            $table->foreign('catcher_id')->references('id')->on('players');
            $table->integer('times_faced');
            $table->string('batter_pos');
            $table->smallInteger('balls');
            $table->smallInteger('strikes');
            $table->smallInteger('outs');
            $table->boolean('man_on_first');
            $table->boolean('man_on_second');
            $table->boolean('man_on_third');
            $table->boolean('end_man_on_first');
            $table->boolean('end_man_on_second');
            $table->boolean('end_man_on_third');
            $table->integer('visiting_team_current_runs');
            $table->integer('home_team_current_runs');
            $table->integer('pitch_result_id')->unsigned();
            $table->foreign('pitch_result_id')->references('id')->on('pitch_results');
            $table->integer('pitch_type_id')->unsigned();
            $table->foreign('pitch_type_id')->references('id')->on('pitch_types');
            $table->decimal('release_velocity',5,2);
            $table->decimal('spin_rate',7,3);
            $table->decimal('spin_direction',7,4);
            $table->decimal('px',6,4);
            $table->decimal('pz',6,4);
            $table->decimal('szt',6,4);
            $table->decimal('szb',6,4);
            $table->decimal('x0',6,4);
            $table->integer('y0');
            $table->decimal('z0',6,4);
            $table->decimal('vx0',6,4);
            $table->decimal('vy0',7,4);
            $table->decimal('vz0',6,4);
            $table->decimal('ax',6,4);
            $table->decimal('ay',6,4);
            $table->decimal('az',6,4);
            $table->decimal('prob_called_strike', 6,5);
            $table->integer('pa_result_id')->unsigned()->nullable();
            $table->foreign('pa_result_id')->references('id')->on('plate_appearance_results');
            $table->integer('runs_home')->nullable();
            $table->integer('batted_ball_type_id')->unsigned()->nullable();
            $table->foreign('batted_ball_type_id')->references('id')->on('batted_ball_types');
            $table->decimal('batted_ball_angle',5,3);
            $table->decimal('batted_ball_distance',6,3);
            $table->string('atbat_desc');
            $table->timestamps();
        });
        Schema::create('positions', function(Blueprint $table){
            $table->increments('id');
            $table->string('abbr', 5);
            $table->timestamps();
        });
        Schema::create('player_positions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players');
            $table->integer('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->timestamps();
        });
        Schema::create('umpires', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mlb_id')->unsigned()->unique();
            $table->string('name');
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
        Schema::dropIfExists('umpires');
        Schema::dropIfExists('player_positions');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('pitches');
        Schema::dropIfExists('batted_ball_types');
        Schema::dropIfExists('plate_appearance_results');
        Schema::dropIfExists('pitch_types');
        Schema::dropIfExists('pitch_results');
        Schema::dropIfExists('players');
    }
}
