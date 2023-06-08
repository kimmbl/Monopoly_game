<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->foreignId('game_id')->primary()->references('id')->on('lobbies')->onDelete('cascade');
            $table->integer('user1_field')->nullable();
            $table->integer('user2_field')->nullable();
            $table->integer('user3_field')->nullable();
            $table->integer('user4_field')->nullable();
            $table->integer('active_user_id')->nullable();
            $table->integer('active_player')->nullable();
            $table->string('active_action')->nullable();
            $table->integer('must_pay')->nullable();
            $table->integer('prison_user1')->default(0);
            $table->integer('prison_user2')->default(0);
            $table->integer('prison_user3')->default(0);
            $table->integer('prison_user4')->default(0);
            $table->integer('first_dice')->nullable();
            $table->integer('second_dice')->nullable();
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
        Schema::dropIfExists('games');
    }
}
