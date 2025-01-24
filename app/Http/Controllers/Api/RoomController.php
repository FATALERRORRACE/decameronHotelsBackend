<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomSize;
use App\Models\RoomType;
use App\Models\RoomTypeRoomSize;
use App\Models\HotelRoomTypeRoomSize;

class RoomController extends Controller
{
    public function storeRoomTypeRoomSize(Request $request)
    {
        $validatedData = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_size_id' => 'required|exists:room_sizes,id',
        ]);

        RoomTypeRoomSize::insert([
            'room_type_id' => $validatedData['room_type_id'],
            'room_size_id' => $validatedData['room_size_id'],
        ]);

        return response()->json(['message' => 'ok'], 201);
    }

    public function storeHotelRoomTypeRoomSize(Request $request)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_room_size_id' => 'required|exists:room_type_room_size,id',
        ]);

        HotelRoomTypeRoomSize::create([
            'hotel_id' => $validatedData['hotel_id'],
            'room_type_room_size_id' => $validatedData['room_type_room_size_id'],
        ]);

        return response()->json(['message' => 'ok'], 201);
    }

    public function getRoomType(){
        $menus = RoomType::all();
        return response()->json($menus);
    }

    public function getRoomSize(){
        $menus = RoomSize::all();
        return response()->json($menus);
    }
}