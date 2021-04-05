<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id');
            $table->foreignId('type_id', 100);
            $table->string('rent')->nullable();
            $table->string('person', 50)->nullable();
            $table->string('price', 100)->nullable();
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
