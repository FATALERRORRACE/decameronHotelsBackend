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

        RoomSize::insert(
            [
                [
                    'label' =>
                ]
            ]
        );
        RoomType::insert(
            [
                [
                    'label' =>
                ]
            ]
        );
        Hotels::insert(
            [
                [
                    'name' => 'DECAMERON CARTAGENA',
                    'address' => 'CALLE 23 58-25',
                    'city' => 'Cartagena',
                    'nit' => '00000001',
                    'room_amount' => 45
                ],
                [
                    'name' => 'DECAMERON GALEON',
                    'address' => 'CALLE 23 58-25',
                    'city' => 'Santa Marta',
                    'nit' => '00000002',
                    'room_amount' => 35,
                ],
                [
                    'name' => 'DECAMERON ISLEÑO',
                    'address' => 'CALLE 23 58-25',
                    'city' => 'San Andres',
                    'nit' => '00000003',
                    'room_amount' => 42,
                ]
            ]
        );
    }
}
