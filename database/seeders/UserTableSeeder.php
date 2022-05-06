<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'name' => 'daisukekubota',
                'nikename' => 'lifeanalytics',
                'email' => 'daisukekubota@outlook.jp',
                'password' => bcrypt('emjoyimaging@lifeanalytics.org'),
                'role' => 'admin',
                'permission' => 'approved'
            ),
            array(
                'name' => 'customer',
                'nikename' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('customer'),
                'role' => 'customer',
                'permission' => 'approved'
            ),
            array(
                'name' => 'agency',
                'nikename' => 'agency',
                'email' => 'agency@gmail.com',
                'password' => bcrypt('agency'),
                'role' => 'agency',
                'permission' => 'approved'
            ),
        );

        DB::table('users')->insert($data);
    }
}
