<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_units', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
			$table->integer('project_id')->nullable();
			$table->string('tower_id',180)->nullable();
			$table->string('units_id',180)->nullable();
			$table->text('floor_details')->nullable();
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
        Schema::dropIfExists('project_units');
    }
}
