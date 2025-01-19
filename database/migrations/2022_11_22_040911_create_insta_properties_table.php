<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstaPropertiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('insta_properties', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->string('property_for', 50)->nullable();
			$table->string('property_type', 50)->nullable();
			$table->string('specific_type', 50)->nullable();
			$table->integer('building_id')->nullable();
			$table->string('property_wing', 50)->nullable();
			$table->string('property_unit_no', 50)->nullable();
			$table->string('configuration', 50)->nullable();
			$table->string('super_builtup_area', 50)->nullable();
			$table->string('super_builtup_measurement', 50)->nullable();
			$table->string('plot_area', 50)->nullable();
			$table->string('plot_measurement', 50)->nullable();
			$table->string('terrace', 50)->nullable();
			$table->string('terrace_measuremnt', 50)->nullable();
			$table->string('hot_property', 50)->nullable();
			$table->string('furnished_status', 50)->nullable();
			$table->string('commision', 50)->nullable();
			$table->string('source_of_property', 50)->nullable();
			$table->string('price', 50)->nullable();
			$table->text('property_remarks')->nullable();
			$table->string('is_specific_number', 50)->nullable();
			$table->string('owner_contact_specific_no', 50)->nullable();
			$table->string('owner_name', 50)->nullable();
			$table->string('owner_number', 50)->nullable();
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
		Schema::dropIfExists('insta_properties');
	}
}
