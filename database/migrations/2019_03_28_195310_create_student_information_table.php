<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInformationTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('student_information', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('first_name');
      $table->string('middle_name');
      $table->string('last_name');
      $table->string('gender');
      $table->string('birth_date');
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
    Schema::dropIfExists('student_information');
  }
}
