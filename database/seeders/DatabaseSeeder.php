<?php

namespace Database\Seeders;

use App\Models\Hotels;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Hotels::factory()->create([
            'name' => 'DECAMERON CARTAGENA',
            'address' => 'CALLE 23 58-25',
            'city' => 'Cartagena',
            'nit' => 'Test User',
            'roomAmount' => 'Test User',
        ]);
        
    }
}
