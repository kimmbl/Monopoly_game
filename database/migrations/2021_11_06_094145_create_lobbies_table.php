<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lobbies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user1_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user2_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user3_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user4_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->boolean('user1_left')->default('0');
            $table->boolean('user2_left')->default('0');
            $table->boolean('user3_left')->default('0');
            $table->boolean('user4_left')->default('0');
            $table->foreignId('winner_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_started')->default('0');
            $table->boolean('is_ended')->default('0');
            $table->bigInteger('started_at')->nullable();
            $table->bigInteger('ended_at')->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('lobbies');
    }
}
