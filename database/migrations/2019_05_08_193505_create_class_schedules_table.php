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
      $table->dateTime('date_start')->nullable();
      $table->dateTime('date_end')->nullable();
      $table->integer('instructor_id')->nullable();
      $table->integer('class_rate_id')->nullable();
      $table->integer('subject_id')->nullable();
      $table->integer('classroom_id')->nullable();
      $table->boolean('status')->default(1);
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
