<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_property', function (Blueprint $table) {
            $table->id();
			$table->integer('main_owner_id')->nullable();
			$table->integer('owner_id')->nullable();
			$table->integer('property_id')->nullable();
			$table->integer('accepted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shared_property');
    }
}
