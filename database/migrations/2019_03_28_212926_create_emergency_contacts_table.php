<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyContactsTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('emergency_contacts', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('student_info_id');
      $table->string('full_name');
      $table->integer('phone_number');
      $table->string('relationship');
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
    Schema::dropIfExists('');
  }
}
