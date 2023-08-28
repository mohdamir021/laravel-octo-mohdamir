<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theaterslot', function (Blueprint $table) {
            $table->id();

            //Attributes
            $table->integer('movie_id');
            $table->integer('theater_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('room_no');
            
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
        Schema::dropIfExists('theaterslot');
    }
};
