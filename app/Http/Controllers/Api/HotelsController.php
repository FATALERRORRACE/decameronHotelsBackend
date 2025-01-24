<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;

class HotelsController extends Controller {

    public function getAllHotelData()
    {
        $hotels = Hotels::all();
        return response()->json($hotels);
    }
    public function saveHotelData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'nit' => 'required|string|max:20',
            'roomamount' => 'required|integer|min:1',
        ]);

        if (Hotels::where('name', $request->input('name'))->orWhere('nit', $request->input('nit'))->exists())
            return response()->json(['message' => 'El Hotel ya se encuentra creado'], 400);

        $hotel = new Hotels();
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->city = $request->input('city');
        $hotel->nit = $request->input('nit');
        $hotel->room_amount = $request->input('roomamount');
        $hotel->save();

        return response()->json(['message' => 'Nuevo Hotel creado']);
    }
}
