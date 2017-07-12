<?php
use Illuminate\Database\Seeder;
use Pmis\Eloquent\User;

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/8/15
 * Time: 5:28 PM
 */
class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->truncate();

        $user = new User();
        $user->fill([
            'name'     => 'Admin',
            'office_id'=> 1,
            'email'    => 'prakash@youngminds.com.np',
            'password' => 'prakash',
            'type'     => 'Super Admin',
            'status'   => 1
        ])->save();

    }
}