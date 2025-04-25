<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatives;

class AlternativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $file_path = resource_path('csv/alternatives_csv.csv');

        Alternatives::truncate();
        $csvFile = fopen($file_path, 'r');
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ';')) !== false) {
            if (!$firstline) {
                Alternatives::create([
                    'name' => $data['1'],
                    'dutch_name' => $data['2'],
                    'alternatives' => $data['3'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
