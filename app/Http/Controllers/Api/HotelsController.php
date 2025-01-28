<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Providers\AppServiceProvider;
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

    public function editHotelData($id = null,Request $request){

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

        $relations = AppServiceProvider::registerRoomTypeRoomSize($request->dataRooms, $hotel->id);
        HotelRoomTypeRoomSize::where('hotel_id', $id)->delete();

        if (!empty($relations)) {
            $createRelation = HotelRoomTypeRoomSize::insert($relations);
            if (!$createRelation)
                return response()->json(['message' => 'ERROR CREANDO RELACIONES']);
        }

        return response()->json(
            [
                'message' => 'Hotel Editado',
                'data' => [
                    'id' => $id,
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'nit' => $request->input('nit'),
                    'room_amount' => $request->input('roomAmount'),
                ]
            ]
        );
    }

    public function newHotelData(Request $request){

        $relations = [];

        if (Hotels::where('name', $request->name)->orWhere('nit', $request->nit)->exists())
            return response()->json(['message' => 'El Hotel ya se encuentra creado']);

        $hotel = new Hotels();
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->city = $request->input('city');
        $hotel->nit = $request->input('nit');
        $hotel->room_amount = $request->input('roomamount');
        $hotel->save();
        $relations = AppServiceProvider::registerRoomTypeRoomSize($request->dataRooms, $hotel->id);

        if (!empty($relations)) {
            $createRelation = HotelRoomTypeRoomSize::insert($relations);
            if (!$createRelation)
                return response()->json(['message' => 'ERROR CREANDO RELACIONES']);
        }

        return response()->json(
            [
                'message' => 'Nuevo Hotel creado',
                'data' => [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'address' => $hotel->address,
                    'city' => $hotel->city,
                    'nit' => $hotel->nit,
                    'roomAmount' => $hotel->room_amount,
                ]
            ]
        );
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
            $hotelData['rooms'][$roomTypeRoomSize->room_type_id][$roomTypeRoomSize->room_size_id] = $hotelRoomType->room_amount;
        }

        return response()->json($hotelData);
    }
}
