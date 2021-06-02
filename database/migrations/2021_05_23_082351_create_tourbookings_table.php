<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourbookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id');
            $table->string('no_of_persons', 100)->nullable();
            $table->date('date')->nullable();
            $table->string('arrival_time', 50);
            $table->string('fname', 100)->nullable();
            $table->string('lname', 100)->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->string('email', 70)->nullable();
            $table->string('pick_up_location', 100)->nullable();
            $table->longText('message')->nullable();
            $table->enum('status', ['a', 'd'])->default('a');
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
        Schema::dropIfExists('tourbookings');
    }
}
