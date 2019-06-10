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
      $table->unsignedInteger('student_id')->nullable();
      $table->string('name')->nullable();
      $table->string('year_attended')->nullable();
      $table->string('notes')->nullable();
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
