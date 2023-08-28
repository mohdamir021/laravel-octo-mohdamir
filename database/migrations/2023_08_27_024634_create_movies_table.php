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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            // Attributes
            $table->string('title');
            $table->date('release');
            $table->integer('length');
            $table->longText('description');
            $table->string('mpaa_rating');
            $table->string('genre');
            $table->string('director');
            $table->string('performer');
            $table->string('language');
            
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
        Schema::dropIfExists('movies');
    }
};
