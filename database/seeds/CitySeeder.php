<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('cities')->insert([
            'name' => 'Hòa Bình'
        ]);
        DB::table('cities')->insert([
            'name' => 'Lạng Sơn'
        ]);
        DB::table('cities')->insert([
            'name' => 'Lào Cai'
        ]);
        DB::table('cities')->insert([
            'name' => 'Yên Bái'
        ]);
        DB::table('cities')->insert([
            'name' => 'Điện Biên'
        ]);
    }
}
