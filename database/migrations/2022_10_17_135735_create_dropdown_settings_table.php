<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropdownSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropdown_settings', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
			$table->string('dropdown_for',100)->nullable();
			$table->string('name',180)->nullable();
			$table->integer('parent_id')->nullable();
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
        Schema::dropIfExists('dropdown_settings');
    }
}
