<?php
use Illuminate\Database\Seeder;
use Pmis\Eloquent\Zone;

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/8/15
 * Time: 5:28 PM
 */

class ZoneTableSeeder extends Seeder {

    public function run()
    {
        DB::table('zones')->truncate();

        $zones = (array)json_decode('[{"id":"1","name":"Mechi"},{"id":"2","name":"Rapti"},{"id":"3","name":"Bagmati"},{"id":"4","name":"Karnali"},{"id":"5","name":"Sagarmatha"},{"id":"6","name":"Koshi"},{"id":"7","name":"Narayani"},{"id":"8","name":"Mahakali"},{"id":"9","name":"Gandaki"},{"id":"10","name":"Janakpur"},{"id":"11","name":"Lumbini"},{"id":"12","name":"Seti"},{"id":"13","name":"Bheri"},{"id":"14","name":"Dhawalagiri"}]',true);
        Zone::insert($zones);
    }
}