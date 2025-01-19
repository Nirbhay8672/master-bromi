<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggedinTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loggedin', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->integer('employee_id')->nullable();
			$table->integer('succeed')->default(0);
			$table->string('ipaddress',180)->nullable();
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
		Schema::dropIfExists('loggedin');
	}
}
