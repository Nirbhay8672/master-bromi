<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_progress', function (Blueprint $table) {
            $table->id();
			$table->integer('enquiry_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('progress',160)->nullable();
			$table->string('lead_type',160)->nullable();
			$table->integer('sales_comment_id')->nullable();
			$table->dateTime('nfd')->nullable();
			$table->text('remarks')->nullable();
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
        Schema::dropIfExists('enquiry_progress');
    }
}
