<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_areas', function (Blueprint $table) {
        	$table->id();
			$table->string('name', 191)->nullable();
			$table->integer('super_city_id')->nullable();
			$table->string('pincode',180)->nullable();
			$table->integer('state_id')->nullable();
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
        Schema::dropIfExists('super_areas');
    }
}
