<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickScheduleVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_schedule_visit', function (Blueprint $table) {
            $table->id();
			$table->integer('enquiry_id')->nullable();
			$table->string('visit_status',180)->nullable();
			$table->text('description')->nullable();
			$table->dateTime('visit_date')->nullable();
			$table->integer('assigned_to')->nullable();
			$table->integer('assigned_by')->nullable();
			$table->integer('schedule_remind')->nullable();
			$table->text('property_list')->nullable();
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
        Schema::dropIfExists('quick_schedule_visit');
    }
}
