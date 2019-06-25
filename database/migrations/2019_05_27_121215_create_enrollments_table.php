<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->bigIncrements('enrollment_id');
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('credits')->nullable();
            $table->unsignedInteger('credit_type_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('amount_balance')->nullable();
            $table->date('enrolled_date')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('enrollments');
    }
}
