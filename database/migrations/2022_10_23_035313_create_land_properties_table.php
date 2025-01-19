<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_properties', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
			$table->string('specific_type', 50)->nullable();
			$table->integer('district_id')->nullable();
			$table->integer('taluka_id')->nullable();
			$table->integer('village_id')->nullable();
			$table->string('zone', 50)->nullable();
			$table->string('fsi', 180)->nullable();
			$table->integer('configuration')->nullable();
			$table->string('survey_number', 180)->nullable();
			$table->integer('plot_size')->nullable();
			$table->integer('plot_measurement')->nullable();
			$table->string('price',160)->nullable();
			$table->string('tp_number', 180)->nullable();
			$table->string('fp_number', 180)->nullable();
			$table->integer('plot2_size')->nullable();
			$table->integer('plot2_measurement')->nullable();
			$table->integer('price2')->nullable();
			$table->text('address')->nullable();
			$table->text('remarks')->nullable();
			$table->integer('status')->nullable();
			$table->text('location_url')->nullable();
			$table->integer('property_source')->nullable();
			$table->string('refrence',180)->nullable();
			$table->text('owner_details')->nullable();
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
        Schema::dropIfExists('land_properties');
    }
}
