<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
	protected $table = 'student_information';
  	protected $guarded = [];

	// public function emergency_contact()
	// {
	// 	return $this->hasOne(EmergencyContact::class);
	// }
}
