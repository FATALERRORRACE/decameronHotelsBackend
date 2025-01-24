<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\HotelsController;
use App\Http\Controllers\Api\RoomController;

// --- MENU ---
Route::get('/menu', [MenuController::class, 'getAllMenuData']);

// --- HOTELS ---
Route::get('/hotels/list', [HotelsController::class, 'getAllHotelData']);
Route::post('/hotels/new', [HotelsController::class, 'saveHotelData']);

// --- ROOMS ---
Route::post('/hotels/rooms/', [RoomController::class, 'storeRoomTypeRoomSize']);
Route::post('/hotels/rooms/size', [RoomController::class, 'storeHotelRoomTypeRoomSize']);
Route::get('/hotels/rooms/size', [RoomController::class, 'getRoomSize']);
Route::get('/hotels/rooms/type', [RoomController::class, 'getRoomType']);