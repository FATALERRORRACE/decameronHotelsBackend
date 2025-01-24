<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    protected $table = 'hotels';
    protected $fillable  = [
        'name',
        'address',
        'city',
        'nit',
        'room_amount'
    ];
}
