<?php 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MixesTableSeeder extends Seeder
{
/**
* Run the database seeds.
*/
public function run()
{
 $file_path = resource_path('sql/mixes.sql');

        DB::unprepared(
            file_get_contents($file_path)
        );
}
}