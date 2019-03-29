<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationBackgroundsTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('education_backgrounds', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('student_info_id');
      $table->string('school_name');
      $table->string('current_level');
      $table->string('status');
      $table->string('phone_number');
      $table->string('address');
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
    Schema::dropIfExists('education_backgrounds');
  }
}
