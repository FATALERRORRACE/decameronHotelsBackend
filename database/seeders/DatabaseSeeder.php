<?php

namespace Database\Seeders;

use App\Models\Hotels;
use App\Models\RoomSize;
use App\Models\RoomType;
use App\Models\Menu;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Menu::insert(
            [
                [
                    'label' => "Registrar Nuevo Hotel"
                ]
            ]
        );

        RoomSize::insert(
            [
                [
                    'label' => "Sencilla",
                    "icon" => "RoomSize",
                    "allowed_room_type"=>"3,5"
                ],[
                    'label' => "Doble",
                    "icon" => "RoomSize",
                    "allowed_room_type"=>"3,5"
                ],[
                    'label' => "Triple",
                    "icon" => "RoomSize",
                    "allowed_room_type"=>"4,5"
                ],[
                    'label' => "Cuádruple",
                    "icon" => "RoomSize",
                    "allowed_room_type"=>"4"
                ]
            ]
        );
        RoomType::insert(
            [
                [
                    'id' => 3,
                    'label' => "Estandar",
                    'icon' => "icon",
                ],
                [
                    'id' => 4,
                    'label' => "Junior",
                    'icon' => "icon",
                ],
                [
                    'id' => 5,
                    'label' => "Suite",
                    'icon' => "icon"
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
