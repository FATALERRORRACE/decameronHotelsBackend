<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\RoomTypeRoomSize;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    static public function registerRoomTypeRoomSize($data, $hotel_id): array{
        $relations = [];
        foreach ($data as $keyRoomType => $roomType) {
            foreach ($roomType as $keyRoomSize => $roomsize) {
                if(empty($roomsize)) continue;

                $relation = RoomTypeRoomSize::where('room_type_id', $keyRoomType)
                    ->where('room_size_id', $keyRoomSize)->first();

                if (!$relation) {
                    $createRelation = RoomTypeRoomSize::insert([
                        'room_type_id' => $keyRoomType,
                        'room_size_id' => $keyRoomSize
                    ]);
                    if(!$createRelation){
                        return response()->json(['message' => 'ERROR CREANDO RELACIONES']);
                    }
                    $relation = RoomTypeRoomSize::where('room_type_id', $keyRoomType)
                        ->where('room_size_id', $keyRoomSize)->first();
                }
                $relations[] = [
                    'room_type_room_size_id' => $relation->id,
                    'hotel_id' => $hotel_id,
                    'room_amount' => $roomsize,
                ];
            }
        }
        return $relations;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
