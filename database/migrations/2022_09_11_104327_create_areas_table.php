<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id')->nullable();
			$table->string('name', 191)->nullable();
			$table->integer('city_id')->nullable();
			$table->string('pincode',180)->nullable();
			$table->integer('state_id')->nullable();
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
		Schema::dropIfExists('areas');
	}
}
