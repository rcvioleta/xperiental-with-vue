<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Resources\Json\Resource;

class ClassScheduleCollection extends Resource
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'class_date' => $this->class_date,
      'start_time' => $this->start_time,
      'end_time' => $this->end_time,
      'class_rate_id' => $this->class_rate_id,
      'subject_id' => $this->subject_id,
      'classroom_id' => $this->classroom_id,
      'students' => $this->students,
      'status' => $this->status
    ];
  }
}
