<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_images', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
			$table->integer('building_id')->nullable();
			$table->string('category',50)->nullable();
			$table->string('image',180)->nullable();
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
        Schema::dropIfExists('building_images');
    }
}
