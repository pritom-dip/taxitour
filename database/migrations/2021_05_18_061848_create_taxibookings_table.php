<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxibookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxibookings', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->string('airport', 50)->nullable();
            $table->string('arrival_time', 50)->nullable();
            $table->string('pick_up_time', 50)->nullable();
            $table->date('date')->nullable()->nullable();
            $table->string('flight_no', 100)->nullable();
            $table->string('no_of_persons', 100)->nullable();
            $table->string('fname', 100)->nullable();
            $table->string('lname', 100)->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->string('email', 70)->nullable();
            $table->string('pick_up_location', 100)->nullable();
            $table->string('departure_city', 100)->nullable();
            $table->string('room_no', 100)->nullable();
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('taxibookings');
    }
}
