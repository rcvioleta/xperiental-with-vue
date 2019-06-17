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
      $table->string('id_num')->nullable();
      $table->string('image')->nullable();
      $table->string('first_name')->nullable();
      $table->string('middle_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('gender')->nullable();
      $table->string('birth_date')->nullable();
      $table->string('phone_number')->nullable();
      $table->string('address')->nullable();
      $table->string('emcon_full_name')->nullable();
      $table->string('emcon_phone_number')->nullable();
      $table->string('emcon_relationship')->nullable();
      $table->string('emcon_address')->nullable();
      $table->boolean('status')->default(true);
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
