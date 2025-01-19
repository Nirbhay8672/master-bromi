<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->integer('parent_id')->nullable();
			$table->string('first_name', 180)->nullable();
			$table->string('middle_name', 180)->nullable();
			$table->string('last_name', 180)->nullable();
			$table->date('birth_date')->nullable();
			$table->date('hire_date')->nullable();
			$table->date('subscribed_on')->nullable();
			$table->string('pincode', 180)->nullable();
			$table->integer('city_id')->nullable();
			$table->integer('state_id')->nullable();
			$table->string('mobile_number', 180)->nullable();
			$table->string('office_number', 180)->nullable();
			$table->string('home_number', 180)->nullable();
			$table->string('position', 180)->nullable();
			$table->string('branch_id',180)->nullable();
			$table->string('reporting_to',180)->nullable();
			$table->string('property_for_id',180)->nullable();
			$table->string('property_type_id',180)->nullable();
			$table->text('specific_properties')->nullable();
			$table->string('driving_license',180)->nullable();
			$table->text('buildings')->nullable();
			$table->string('email',180)->unique()->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password')->nullable();
			$table->integer('role_id')->default(2)->comment('1=Admin, 2=TA/TP');
			$table->string('vendor_id', 10)->nullable();
			$table->text('address')->nullable();
			$table->tinyInteger('status')->default(1);
			$table->integer('plan_id')->nullable();
			$table->integer('working')->nullable();
			$table->rememberToken();
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
		Schema::dropIfExists('users');
	}
}
