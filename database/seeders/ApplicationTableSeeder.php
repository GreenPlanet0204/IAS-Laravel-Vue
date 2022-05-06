<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ApplicationTableSeeder extends Seeder
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
                'app_name' => 'IAS',
                'cat_id' => '1',
                'category_tab' => 'IAS001M1',
                'period_date' => '30',
                'capacity' => '500',
                'capacity_unit' => 'G',
                'price' => '360',
                'discount' => '15',
                'discount_price' => '306'
            ),
            array(
                'app_name' => 'IAS',
                'cat_id' => '2',
                'category_tab' => 'IAS001M2',
                'period_date' => '90',
                'capacity' => '500',
                'capacity_unit' => 'G',
                'price' => '1000',
                'discount' => '15',
                'discount_price' => '850'
            ),
            array(
                'app_name' => 'IAS',
                'cat_id' => '3',
                'category_tab' => 'IAS001Y1',
                'period_date' => '365',
                'capacity' => '500',
                'capacity_unit' => 'G',
                'price' => '3600',
                'discount' => '15',
                'discount_price' => '3060'
            ),
            array(
                'app_name' => 'IAS',
                'cat_id' => '4',
                'category_tab' => 'IAS001Y2',
                'period_date' => '365',
                'capacity' => '2',
                'capacity_unit' => 'T',
                'price' => '14400',
                'discount' => '15',
                'discount_price' => '12240'
            )
        );

        DB::table('applications')->insert($data);
    }
}
