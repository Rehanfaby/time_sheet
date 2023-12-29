<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheetreports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->integer('expected_hours');
            $table->integer('total_hours');
            $table->integer('over_time');
            $table->string('staff')->nullable();
            $table->date('from');
            $table->date('to');
            $table->text('description')->nullable();
            $table->tinyInteger('is_approve')->default(0);
            $table->tinyInteger('approved_by')->nullable();
            $table->tinyInteger('is_sign')->default(0);
            $table->tinyInteger('signed_by')->nullable();
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
        Schema::dropIfExists('timesheetreports');
    }
}
