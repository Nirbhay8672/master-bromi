<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enquiries', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->string('client_name', 180)->nullable();
			$table->string('client_mobile', 180)->nullable();
			$table->string('client_email', 180)->nullable();
			$table->integer('is_nri')->default(0);
			$table->string('enquiry_for', 50)->nullable();
			$table->string('requirement_type', 180)->nullable();
			$table->string('property_type', 180)->nullable();
			$table->string('configuration', 180)->nullable();
			$table->string('area_from', 50)->nullable();
			$table->string('area_to', 50)->nullable();
			$table->string('area_from_measurement', 50)->nullable();
			$table->string('area_to_measurement', 50)->nullable();
			$table->string('enquiry_source', 50)->nullable();
			$table->string('furnished_status', 50)->nullable();
			$table->string('budget_from', 50)->nullable();
			$table->string('budget_to', 50)->nullable();
			$table->string('purpose', 50)->nullable();
			$table->string('building_id',180)->nullable();
			$table->string('enquiry_status', 50)->nullable();
			$table->string('project_status', 50)->nullable();
			$table->text('area_ids')->nullable();
			$table->integer('is_preleased')->default(0);
			$table->integer('no_care_customer')->default(0);
			$table->text('other_contacts')->nullable();
			$table->text('telephonic_discussion')->nullable();
			$table->text('highlights')->nullable();
			$table->integer('enquiry_city_id')->nullable();
			$table->string('enquiry_branch_id',100)->nullable();
			$table->string('employee_id',100)->nullable();
			$table->integer('is_favourite')->nullable();
			$table->dateTime('transfer_date')->nullable();
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
		Schema::dropIfExists('enquiries');
	}
}
