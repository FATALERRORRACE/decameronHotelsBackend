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
        if (!Schema::hasTable('room_type_room_size'))
        Schema::create('room_type_room_size', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('room_type_id');
            $table->foreign('room_type_id')->references('id')->on('room_type')->onDelete('cascade');
            $table->unsignedInteger('room_size_id');
            $table->foreign('room_size_id')->references('id')->on('room_size')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('room_type_room_size');
    }
};
