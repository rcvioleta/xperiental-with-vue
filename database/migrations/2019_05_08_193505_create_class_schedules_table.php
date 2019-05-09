<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSchedulesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('class_schedules', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->date('class_date');
      $table->string('start_time');
      $table->string('end_time');
      $table->integer('student_id');
      $table->integer('class_rate_id');
      $table->integer('subject_id');
      $table->integer('classroom_id');
      $table->integer('status');
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
    Schema::dropIfExists('class_schedules');
  }
}
