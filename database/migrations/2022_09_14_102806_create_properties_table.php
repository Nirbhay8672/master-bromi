<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->string('property_for', 180)->nullable();
			$table->string('property_type', 180)->nullable();
			$table->string('property_category', 180)->nullable();
			$table->string('configuration', 180)->nullable();
			$table->string('project_id', 180)->nullable();
			$table->string('city_id', 180)->nullable();
			$table->string('locality_id', 180)->nullable();
			$table->string('address', 180)->nullable();
			$table->string('location_link', 180)->nullable();
			$table->string('district_id', 180)->nullable();
			$table->string('taluka_id', 180)->nullable();
			$table->string('village_id', 180)->nullable();
			$table->string('zone_id', 180)->nullable();
			$table->string('constructed_carpet_area', 180)->nullable();
			$table->string('constructed_salable_area', 180)->nullable();
			$table->string('constructed_builtup_area', 180)->nullable();
			$table->string('salable_plot_area', 180)->nullable();
			$table->string('carpet_plot_area', 180)->nullable();
			$table->string('salable_area', 180)->nullable();
			$table->string('carpet_area', 180)->nullable();
			$table->string('storage_centre_height', 180)->nullable();
			$table->string('length_of_plot', 180)->nullable();
			$table->string('width_of_plot', 180)->nullable();
			$table->string('entrance_width', 180)->nullable();
			$table->string('ceiling_height', 180)->nullable();
			$table->string('builtup_area', 180)->nullable();
			$table->string('plot_area', 180)->nullable();
			$table->string('terrace', 180)->nullable();
			$table->string('construction_area', 180)->nullable();
			$table->string('terrace_carpet_area', 180)->nullable();
			$table->string('terrace_salable_area', 180)->nullable();
			$table->string('total_units_in_project', 180)->nullable();
			$table->string('total_no_of_floor', 180)->nullable();
			$table->string('total_units_in_tower', 180)->nullable();
			$table->string('property_on_floors', 180)->nullable();
			$table->string('no_of_elavators', 180)->nullable();
			$table->string('no_of_balcony', 180)->nullable();
			$table->string('total_no_of_units', 180)->nullable();
			$table->string('no_of_room', 180)->nullable();
			$table->string('no_of_bathrooms', 180)->nullable();
			$table->string('washrooms2_type', 180)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('properties');
	}
}
