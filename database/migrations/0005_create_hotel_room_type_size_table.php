<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (!Schema::hasTable('hotel_room_type_room_size'))
            Schema::create('hotel_room_type_room_size', function (Blueprint $table) {
                $table->unsignedInteger('hotel_id');
                $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
                $table->unsignedInteger('room_type_room_size_id');
                $table->foreign('room_type_room_size_id')->references('id')->on('room_type_room_size')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('hotel_room_type_room_size');
    }
};
