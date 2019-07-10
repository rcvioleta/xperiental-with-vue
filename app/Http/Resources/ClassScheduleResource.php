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
      'date_start' => $this->date_start,
      'date_end' => $this->date_end,
      'instructor_id' => $this->instructor_id,
      'class_rate_id' => $this->class_rate_id,
      'subject_id' => $this->subject_id,
      'grade_id' => $this->grade_id,
      'status' => $this->status
    ];
  }
}
