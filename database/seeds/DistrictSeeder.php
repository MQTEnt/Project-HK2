<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('districts')->insert([
            'name' => 'Lương Sơn',
            'city_id' => 1
        ]);
        DB::table('districts')->insert([
            'name' => 'Cao Phong',
            'city_id' => 1
        ]);
        DB::table('districts')->insert([
            'name' => 'Mai Châu',
            'city_id' => 1
        ]);
        DB::table('districts')->insert([
            'name' => 'Bắc Sơn',
            'city_id' => 2
        ]);
        DB::table('districts')->insert([
            'name' => 'Cao Lộc',
            'city_id' => 2
        ]);
        DB::table('districts')->insert([
            'name' => 'Văn Quan',
            'city_id' => 2
        ]);
        DB::table('districts')->insert([
            'name' => 'Bảo Thắng',
            'city_id' => 3
        ]);
        DB::table('districts')->insert([
            'name' => 'Bảo Yên',
            'city_id' => 3
        ]);
        DB::table('districts')->insert([
            'name' => 'Bát Xát',
            'city_id' => 3
        ]);
        DB::table('districts')->insert([
            'name' => 'Lục Yên',
            'city_id' => 4
        ]);
        DB::table('districts')->insert([
            'name' => 'Văn Chấn',
            'city_id' => 4
        ]);
        DB::table('districts')->insert([
            'name' => 'Mường Chà',
            'city_id' => 5
        ]);
    }
}
