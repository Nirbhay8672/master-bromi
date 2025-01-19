<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
			$table->string('project_name',180)->nullable();
			$table->integer('builder_id')->nullable();
			$table->integer('area_id')->nullable();
			$table->integer('state_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->string('address',180)->nullable();
			$table->string('pincode',180)->nullable();
			$table->integer('status')->default(1);
			$table->string('email',180)->nullable();
			$table->integer('floor_count')->nullable();
			$table->integer('unit_no')->nullable();
			$table->integer('lift_count')->nullable();
			$table->string('property_type', 180)->nullable();
			$table->integer('building_posession')->nullable();
			$table->string('restrictions',180)->nullable();
			$table->integer('building_status')->nullable();
			$table->string('building_quality', 180)->nullable();
			$table->text('security_details')->nullable();
			$table->string('change',180)->nullable();
			$table->string('project_description',180)->nullable();
			$table->text('contact_details')->nullable();
			$table->string('amenities',180)->nullable();
			$table->string('project_status',180)->nullable();
			$table->text('tower_details')->nullable();
			$table->text('unit_details')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
