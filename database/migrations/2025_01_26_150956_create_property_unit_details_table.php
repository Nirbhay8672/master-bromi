<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyUnitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_unit_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('wing')->nullable();
            $table->integer('unit_no');
            // $table->integer('unit_unit_no');
            $table->tinyInteger('availability_status')->nullable()->comment('0 => Available, 1 => Rent Out, 2 => Sold Out');
            $table->double('price_rent')->nullable();
            $table->tinyInteger('furniture_status')->nullable()->comment('0 => Furnished, 1 => Semi-Furnished, 2 => Unfurnished, 2 => Can Furnish');            
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
        Schema::dropIfExists('property_unit_details');
    }
}
