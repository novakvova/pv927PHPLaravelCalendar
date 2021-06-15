<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_images', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->integer("priority")->default(0);
            $table->boolean('is_main')->default(false);
            $table->unsignedBigInteger('id_car')->nullable();
            $table->timestamps();

            $table->foreign('id_car')
                ->references('id')
                ->on('cars')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_images');
    }
}
