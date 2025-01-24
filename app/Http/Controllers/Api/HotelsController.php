<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\RoomTypeRoomSize;
use App\Models\HotelRoomTypeRoomSize;

class HotelsController extends Controller
{

    public function getAllHotelData()
    {
        $hotels = Hotels::all();
        return response()->json($hotels);
    }

    public function saveHotelData($id = null,Request $request){
        $relations = [];

        if (!$id && Hotels::where('name', $request->name)->orWhere('nit', $request->nit)->exists())
            return response()
                ->json(['message' => 'El Hotel ya se encuentra creado']);

        if($id){

            $hotel = Hotels::find($id);
            if (!$hotel) {
                return response()->json(['message' => 'Hotel no encontrado'], 404);
            }
            $hotel->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'nit' => $request->input('nit'),
                'room_amount' => $request->input('roomAmount'),
            ]);

        }else{

            $hotel = new Hotels();
            $hotel->name = $request->input('name');
            $hotel->address = $request->input('address');
            $hotel->city = $request->input('city');
            $hotel->nit = $request->input('nit');
            $hotel->room_amount = $request->input('roomAmount');
            $hotel->save(); 

        }
        
        foreach ($request->dataRooms as $key => $value) {
            foreach ($value as $roomsize) {
                $relation = RoomTypeRoomSize::where('room_type_id', $key)
                    ->where('room_size_id', $roomsize)->first();

                if (!$relation) {
                    $createRelation = RoomTypeRoomSize::insert([
                        'room_type_id' => $key,
                        'room_size_id' => $roomsize
                    ]);
                    if(!$createRelation){
                        return response()->json(['message' => 'ERROR CREANDO RELACIONES']);
                    }
                    $relation = RoomTypeRoomSize::where('room_type_id', $key)
                        ->where('room_size_id', $roomsize)->first();
                }
                $relations[] = [
                    'room_type_room_size_id' => $relation->id,
                    'hotel_id' => $hotel->id,
                ];
            }
        }
        HotelRoomTypeRoomSize::where('hotel_id', $id)->delete();
        if (!empty($relations)) {
            $createRelation = HotelRoomTypeRoomSize::insert($relations);
            if (!$createRelation)
                return response()->json(['message' => 'ERROR CREANDO RELACIONES']);
        }
        if($id)
            return response()->json(['message' => 'Hotel Editado']);
        else
            return response()->json(['message' => 'Nuevo Hotel creado']);
    }
    public function getHotelData($id){

        $hotel = Hotels::find($id);

        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        $hotelData = [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'address' => $hotel->address,
            'city' => $hotel->city,
            'nit' => $hotel->nit,
            'room_amount' => $hotel->room_amount,
            'rooms' => []
        ];

        $hotelRoomTypes = HotelRoomTypeRoomSize::where('hotel_id', $hotel->id)->get();

        foreach ($hotelRoomTypes as $hotelRoomType) {
            $roomTypeRoomSize = RoomTypeRoomSize::find($hotelRoomType->room_type_room_size_id);
            $hotelData['rooms'][$roomTypeRoomSize->room_type_id][] = $roomTypeRoomSize->room_size_id;
        }

        return response()->json($hotelData);
    }
}
