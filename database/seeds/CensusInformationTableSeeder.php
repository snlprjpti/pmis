<?php
use Illuminate\Database\Seeder;
use Pmis\Eloquent\CensusInformation;

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/28/15
 * Time: 10:42 AM
 */
class CensusInformationTableSeeder extends Seeder {

    public function run()
    {

        CensusInformation::insert([
            'total_population'=>30485798,
            'birth_per_sec'=>0.021431701600076,
            'death_per_sec'=>0.006583215511796,
            'migration_per_sec'=>0.00058968597095383,
            'sex_ratio'=>0.984141416,
            'census_year'=>'2011-06-01',
            'status'=>1,
        ]);
    }
}