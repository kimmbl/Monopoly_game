<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_items', function (Blueprint $table) {
            $table->foreignId('game_id')->primary()->references('id')->on('lobbies')->onDelete('cascade');
            $table->foreignId('user1_item')->nullable()->references('id')->on('items')->onDelete('cascade');
            $table->foreignId('user2_item')->nullable()->references('id')->on('items')->onDelete('cascade');
            $table->foreignId('user3_item')->nullable()->references('id')->on('items')->onDelete('cascade');
            $table->foreignId('user4_item')->nullable()->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_items');
    }
}
