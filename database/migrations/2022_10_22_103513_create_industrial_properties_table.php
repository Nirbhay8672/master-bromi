<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustrialPropertiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('industrial_properties', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->string('property_for', 50)->nullable();
			$table->string('specific_type', 50)->nullable();
			$table->integer('building_id')->nullable();
			$table->integer('area_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->integer('state_id')->nullable();
			$table->string('property_wing', 50)->nullable();
			$table->string('property_unit_no', 50)->nullable();
			$table->string('configuration', 50)->nullable();
			$table->string('property_status', 50)->nullable();
			$table->string('construction_area', 50)->nullable();
			$table->string('construction_measurement', 50)->nullable();
			$table->string('source_of_property', 50)->nullable();
			$table->string('zone', 50)->nullable();
			$table->string('plot_area', 50)->nullable();
			$table->string('plot_measurement', 50)->nullable();
			$table->string('hot_property', 50)->nullable();
			$table->string('commission', 50)->nullable();
			$table->integer('pre_leased')->default(0);
			$table->text('Property_description')->nullable();
			$table->string('price', 50)->nullable();
			$table->text('price_remarks')->nullable();
			$table->text('remarks')->nullable();
			$table->text('address')->nullable();
			$table->text('owner_details')->nullable();
			$table->integer('gpcb')->default(0);
			$table->text('gpcb_remarks')->nullable();
			$table->integer('ec_noc')->default(0);
			$table->text('ec_noc_remarks')->nullable();
			$table->integer('bail')->default(0);
			$table->text('bail_remarks')->nullable();
			$table->integer('discharge')->default(0);
			$table->text('discharge_remarks')->nullable();
			$table->integer('gujrat_gas')->default(0);
			$table->text('gujrat_gas_remarks')->nullable();
			$table->integer('power')->default(0);
			$table->text('power_remarks')->nullable();
			$table->integer('water')->default(0);
			$table->text('water_remarks')->nullable();
			$table->integer('machinery')->default(0);
			$table->text('machinery_remarks')->nullable();
			$table->integer('etl_necpt')->default(0);
			$table->text('etl_necpt_remarks')->nullable();
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
		Schema::dropIfExists('industrial_properties');
	}
}
