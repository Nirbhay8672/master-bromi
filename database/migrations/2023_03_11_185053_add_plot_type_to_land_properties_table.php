<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlotTypeToLandPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('land_properties', function (Blueprint $table) {
			$table->string('plot_type',180)->nullable();
			$table->string('road_width_of_front_side',180)->nullable();
			$table->string('road_width_of_front_side_measurement',180)->nullable();
			$table->string('floors_allowed_for_construction',180)->nullable();
			$table->string('borewell',180)->nullable();
			$table->string('breadth_size',180)->nullable();
			$table->string('breadth_size_measurement',180)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('land_properties', function (Blueprint $table) {
			$table->dropColumn('plot_type');
			$table->dropColumn('road_width_of_front_side');
			$table->dropColumn('road_width_of_front_side_measurement');
			$table->dropColumn('floors_allowed_for_construction');
			$table->dropColumn('borewell');
			$table->dropColumn('breadth_size');
			$table->dropColumn('breadth_size_measurement');
        });
    }
}
