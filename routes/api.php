<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\HotelsController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::get('/menu', [MenuController::class, 'getAllMenuData']);
Route::get('/hotels/list', [HotelsController::class, 'getAllHotelData']);