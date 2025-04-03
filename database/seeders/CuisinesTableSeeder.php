<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuisinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('cuisines')->insert([
            [
                'name' => 'Mediterranian',
                'color' => '#116241',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Indian',
                'color' => '#C63D19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Italian',
                'color' => '#AB691D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'South/East Asian',
                'color' => '#4C1213',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Mexican',
                'color' => '#7F0F00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nordic',
                'color' => '#BE7622',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chinese',
                'color' => '#A83513',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ['name' => 'Japanese','color'=>'#4C1213', 'created_at' => now(), 'updated_at' => now()],
            [
                'name' => 'French',
                'color' => '#4C1213',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vegetables',
                'color' => '#32561A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meats, Fish & Poultry',
                'color' => '#4C1213',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            ['name' => 'Other', 'color' => '#D15825', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
