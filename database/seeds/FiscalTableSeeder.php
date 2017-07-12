<?php
use Illuminate\Database\Seeder;
use Pmis\Eloquent\Fiscal;

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/28/15
 * Time: 10:42 AM
 */
class FiscalTableSeeder extends Seeder {

    public function run()
    {

        Fiscal::insert(['name'=>'2071-2072' ]);
    }
}