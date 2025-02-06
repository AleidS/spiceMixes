<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('measures')->insert([
            ['name' => 'Cup', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gram', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kilogram', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}