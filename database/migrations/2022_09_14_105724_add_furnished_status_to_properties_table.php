<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFurnishedStatusToPropertiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('properties', function (Blueprint $table) {
			$table->string('no_of_floors_allowed', 180)->nullable();
			$table->string('no_of_side_open', 180)->nullable();
			$table->string('service_elavator', 180)->nullable();
			$table->string('servant_room', 180)->nullable();
			$table->string('hot_property', 180)->nullable();
			$table->string('is_favourite', 180)->nullable();
			$table->string('front_road_width', 180)->nullable();
			$table->string('construction_allowed_for', 180)->nullable();
			$table->string('fsi', 180)->nullable();
			$table->string('no_of_borewell', 180)->nullable();
			$table->string('fourwheller_parking', 180)->nullable();
			$table->string('twowheeler_parking', 180)->nullable();
			$table->string('is_pre_leased', 180)->nullable();
			$table->string('pre_leased_remarks', 180)->nullable();
			$table->string('Property_priority', 180)->nullable();
			$table->string('source_of_property', 180)->nullable();
			$table->string('property_source_refrence', 180)->nullable();
			$table->string('availability_status', 180)->nullable();
			$table->string('propertyage', 180)->nullable();
			$table->string('available_from', 180)->nullable();
			$table->string('amenities', 180)->nullable();
			$table->text('other_industrial_fields')->nullable();
			$table->string('two_road_corner', 180)->nullable();
			$table->text('unit_details')->nullable();
			$table->string('survey_number', 180)->nullable();
			$table->string('survey_plot_size', 180)->nullable();
			$table->string('survey_price', 180)->nullable();
			$table->string('tp_number', 180)->nullable();
			$table->string('fp_number', 180)->nullable();
			$table->string('fp_plot_size', 180)->nullable();
			$table->string('fp_plot_price', 180)->nullable();
			$table->string('owner_is', 180)->nullable();
			$table->string('owner_name', 180)->nullable();
			$table->string('owner_contact', 180)->nullable();
			$table->string('owner_email', 180)->nullable();
			$table->string('owner_nri', 180)->nullable();
			$table->text('contact_details')->nullable();
			$table->string('care_taker_name', 180)->nullable();
			$table->string('care_taker_contact', 180)->nullable();
			$table->string('key_available_at', 180)->nullable();
			$table->string('conference_room', 180)->nullable();
			$table->string('reception_area', 180)->nullable();
			$table->string('pantry_type', 180)->nullable();
			$table->string('added_by', 180)->nullable();
			$table->text('remarks')->nullable();
			$table->string('is_terrace', 180)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('properties', function (Blueprint $table) {
			$table->dropColumn('no_of_floors_allowed');
			$table->dropColumn('no_of_side_open');
			$table->dropColumn('service_elavator');
			$table->dropColumn('servant_room');
			$table->dropColumn('hot_property');
			$table->dropColumn('is_favourite');
			$table->dropColumn('front_road_width');
			$table->dropColumn('construction_allowed_for');
			$table->dropColumn('fsi');
			$table->dropColumn('no_of_borewell');
			$table->dropColumn('fourwheller_parking');
			$table->dropColumn('twowheeler_parking');
			$table->dropColumn('is_pre_leased');
			$table->dropColumn('pre_leased_remarks');
			$table->dropColumn('Property_priority');
			$table->dropColumn('source_of_property');
			$table->dropColumn('property_source_refrence');
			$table->dropColumn('availability_status');
			$table->dropColumn('propertyage');
			$table->dropColumn('available_from');
			$table->dropColumn('amenities');
			$table->dropColumn('other_industrial_fields');
			$table->dropColumn('two_road_corner');
			$table->dropColumn('unit_details');
			$table->dropColumn('survey_number');
			$table->dropColumn('survey_plot_size');
			$table->dropColumn('survey_price');
			$table->dropColumn('tp_number');
			$table->dropColumn('fp_number');
			$table->dropColumn('fp_plot_size');
			$table->dropColumn('fp_plot_price');
			$table->dropColumn('owner_is');
			$table->dropColumn('owner_name');
			$table->dropColumn('owner_contact');
			$table->dropColumn('owner_email');
			$table->dropColumn('owner_nri');
			$table->dropColumn('contact_details');
			$table->dropColumn('care_taker_name');
			$table->dropColumn('care_taker_contact');
			$table->dropColumn('key_available_at');
			$table->dropColumn('conference_room');
			$table->dropColumn('reception_area');
			$table->dropColumn('pantry_type');
			$table->dropColumn('added_by');
			$table->dropColumn('is_terrace');
		});
	}
}
