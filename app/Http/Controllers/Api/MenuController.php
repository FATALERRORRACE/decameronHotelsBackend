mi<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

// MenuController -> getAllMenuData
class MenuController extends Controller{

    public function getAllMenuData(){
        $menus = Menu::all();
        return response()->json($menus);
    }
}