<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPropertyMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_master', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->text('address')->nullable();
            $table->string('location_link')->nullable();
            $table->integer('units_in_project')->nullable();
            $table->integer('no_of_floors')->nullable();
            $table->integer('units_in_tower')->nullable();
            $table->integer('units_in_floor')->nullable();
            $table->integer('no_of_elevators')->nullable();
            $table->boolean('service_elevator')->default(0);
            $table->boolean('hot_property')->default(0); 
            $table->tinyInteger('washroom_type')->nullable()->comment('1 => Private, 2 => Public, 3 => Not-Available');
            $table->integer('fourwheller_parking')->nullable();
            $table->integer('twowheller_parking')->nullable();  
            $table->tinyInteger('priority_type')->nullable()->comment('As Per property config');
            $table->tinyInteger('source')->nullable()->comment('As Per property config');
            $table->tinyInteger('availability_status')->nullable()->comment('0 => Under Construction, 1 => Available');
            $table->tinyInteger('property_age')->nullable()->comment('1 => 0-1 Years, 2 => 0-5 Years, 3 => 5-10 Years, 4 => 10+ Years');
            $table->string('available_from')->nullable();
            $table->boolean('is_two_road_corner')->default(0);
            $table->text('remark')->nullable(); 
            $table->json('owner_info')->nullable();
            $table->tinyInteger('key_available_at')->nullable()->comment('1 => Owner, 2 => Office, 3 => Both');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_master', function (Blueprint $table) {
            //
        });
    }
}
