<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mixes;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Pest\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         if (!User::where('email', 'test@test.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => bcrypt('test'), // Ensure you use a secure password
                'remember_token' => Str::random(10),
            ]);
        }
        $this->call([
            MixesTableSeeder::class,
            MeasuresTableSeeder::class,
            MediaTableSeeder::class,  
            CuisinesTableSeeder::class,
             ]);
    }
}