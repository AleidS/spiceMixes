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
            ['name' => 'Tbsp','info'=>'Tablespoon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ts','info'=>'Teaspoon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pinches','info'=>'Pinch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cups', 'info'=>'Cup', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gr','info'=>'Grams', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kg','info'=>'Kilograms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ml','info'=>'millilitres', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'dl','info'=>'decilitre', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'l','info'=>'litre', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}