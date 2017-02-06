<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('PitchResultsSeeder');
        $this->command->info('pitch_results table seeded');
        $this->call('PitchTypesSeeder');
        $this->command->info('pitch_types table seeded');
        $this->call('PlateAppearanceResultsSeeder');
        $this->command->info('plate_appearance_results table seeded');
        $this->call('BattedBallTypesSeeder');
        $this->command->info('batted_ball_types table seeded');
        $this->call('PositionsSeeder');
        $this->command->info('positions table seeded');

        $this->call('PitchesSeeder');
        $this->command->info('pitches table seeded');
        
    }
}