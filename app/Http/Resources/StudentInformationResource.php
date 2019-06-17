<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentInformationResource extends JsonResource
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
      'first_name' => $this->first_name,
      'middle_name' => $this->middle_name,
      'last_name' => $this->last_name,
      'full_name' => $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name,
      'gender' => $this->gender,
      'birth_date' => $this->birth_date,
      'phone_number' => $this->phone_number,
      'address' => $this->address
    ];
  }
}
