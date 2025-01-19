<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rera', function (Blueprint $table) {
            $table->id();
			$table->string('state',180);
			$table->string('district',180);
			$table->string('project_name',180);
			$table->string('promoter_name',180);
			$table->string('reg_no',180);
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
        Schema::dropIfExists('rera');
    }
}
