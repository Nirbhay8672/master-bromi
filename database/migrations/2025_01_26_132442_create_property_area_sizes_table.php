<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAreaSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_area_size', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->double('carpet_area_value');
            $table->unsignedInteger('carpet_area_measurement_id');
            $table->double('ceiling_height_value');
            $table->unsignedInteger('ceiling_height_measurement_id');
            $table->double('salable_area_value');
            $table->unsignedInteger('salable_area_measurement_id');
            $table->double('terrace_carpet_area_value');
            $table->unsignedInteger('terrace_carpet_area_measurement_id');
            $table->double('terrace_salable_area_value');
            $table->unsignedInteger('terrace_salable_area_measurement_id');
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
        Schema::dropIfExists('property_area_sizes');
    }
}
