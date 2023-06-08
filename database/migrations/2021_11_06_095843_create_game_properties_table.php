<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->references('id')->on('lobbies')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->integer('price');
            $table->integer('rent')->nullable();
            $table->integer('house')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_properties');
    }
}
