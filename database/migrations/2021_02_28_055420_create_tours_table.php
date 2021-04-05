<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id');
            $table->string('name');
            $table->string('tour_type')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('destination_id')->nullable();
            $table->foreignId('location_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('duration_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->text('short_desc')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('destination_a', 150)->nullable();
            $table->string('destination_b', 150)->nullable();
            $table->string('min_capacity', 50)->nullable();
            $table->string('max_capacity', 30)->nullable();
            $table->string('location', 30)->nullable();
            $table->string('rating', 10)->nullable();
            $table->integer('price')->nullable();
            $table->string('duration', 40)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('departure_time', 50)->nullable();
            $table->integer('num_of_persons')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
