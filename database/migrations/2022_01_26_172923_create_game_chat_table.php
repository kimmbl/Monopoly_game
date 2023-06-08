<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->text('message');
            $table->foreignId('lobby_id')->unsigned()->references('id')->on('lobbies')->onDelete('cascade');
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
        Schema::dropIfExists('game_chat');
    }
}
