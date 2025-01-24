<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTypeRoomSize extends Model
{
    protected $table = 'room_type_room_size';
    protected $fillable = ['room_type_id'];
}
