<?php 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaTableSeeder extends Seeder
{
/**
* Run the database seeds.
*/
public function run()
{
 $file_path = resource_path('sql/media.sql');

        DB::unprepared(
            file_get_contents($file_path)
        );
}
}