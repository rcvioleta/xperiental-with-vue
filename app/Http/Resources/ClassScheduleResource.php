<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassScheduleResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'students' => $this->students,
      'class_date' => $this->class_date,
      'start_time' => $this->start_time,
      'end_time' => $this->end_time,
      'class_rate_id' => $this->class_rate_id,
      'subject_id' => $this->subject_id,
      'classroom_id' => $this->classroom_id,
      'status' => $this->status
    ];
  }
}
