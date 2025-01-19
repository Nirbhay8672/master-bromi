<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buildings', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->string('name', 191)->nullable();
			$table->integer('builder_id')->nullable();
			$table->integer('area_id')->nullable();
			$table->text('address')->nullable();
			//newly added
			$table->text('landmark')->nullable();
			$table->tinyInteger('is_prime')->default(0);
			$table->integer('posession_year')->nullable();
			$table->integer('floor_count')->nullable();
			$table->integer('unit_no')->nullable();
			$table->integer('lift_count')->nullable();
			$table->string('property_type', 180)->nullable();
			$table->string('restrictions')->nullable();
			$table->integer('building_status')->nullable();
			$table->string('building_quality', 180)->nullable();
			$table->text('building_descriptions')->nullable();
			$table->string('building_amenities', 180)->nullable();
			$table->text('contact_details')->nullable();
			$table->text('security_details')->nullable();
			$table->text('document_images')->nullable();
			//
			$table->integer('city_id')->nullable();
			$table->integer('state_id')->nullable();
			$table->string('pincode', 20)->nullable();
			$table->integer('status')->default(1);
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
		Schema::dropIfExists('buildings');
	}
}
