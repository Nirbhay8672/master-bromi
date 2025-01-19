<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStorageTypeToIndustrialPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('industrial_properties', function (Blueprint $table) {
			$table->string('storage_type',180)->nullable();
			$table->string('road_width_of_front_side',180)->nullable();
			$table->string('road_width_of_front_side_measurement',180)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('industrial_properties', function (Blueprint $table) {
			$table->dropcolumn('storage_type');
			$table->dropcolumn('road_width_of_front_side');
			$table->dropcolumn('road_width_of_front_side_measurement');
        });
    }
}
