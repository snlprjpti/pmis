<?php
use Illuminate\Database\Seeder;
use Pmis\Eloquent\Office;

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/28/15
 * Time: 10:42 AM
 */
class OfficeTableSeeder extends Seeder {

    public function run()
    {

        Office::insert([
            'district_id'=>'12',
            'office_name'=>'Kathmandu Central Office',
            'office_type'=>'Central',
        ]);
    }
}