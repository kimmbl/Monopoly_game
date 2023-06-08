<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->integer('price');
            $table->integer('rent')->nullable();
            $table->integer('house1')->nullable();
            $table->integer('house2')->nullable();
            $table->integer('house3')->nullable();
            $table->integer('house4')->nullable();
            $table->integer('star')->nullable();
            $table->integer('buy_house')->nullable();
            $table->string('type');
            $table->string('family');
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
        Schema::dropIfExists('properties');
    }
}
