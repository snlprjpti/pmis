<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('ZoneTableSeeder');
        $this->call('DistrictTableSeeder');
        $this->call('CountryTableSeeder');
        $this->call('CensusInformationTableSeeder');
        $this->call('OfficeTableSeeder');
        $this->call('FiscalTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('VdcTableSeeder');
    }

}
