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
        $lockfile_str = "/tmp/pitches_seeder.lock";

        ini_set("max_execution_time", 6000);
        ini_set("memory_limit", "-1");

        if(!file_exists($lockfile_str)){
            $lockfile = fopen($lockfile_str, "w");
        }else{
            echo "LockFile exists. Exiting...";
            exit;
        }
        
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
        
        unlink($lockfile_str);
        
    }
}
