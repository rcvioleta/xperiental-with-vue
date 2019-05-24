<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassScheduleRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'class_date' => 'required|date',
      'start_time' => 'required',
      'end_time' => 'required',
      'class_rate_id' => 'required|numeric',
      'subject_id' => 'required|numeric',
      'classroom_id' => 'required|numeric',
      'status' => 'required|max:1',
      'students' => 'required|string'
    ];
  }

  public function attributes()
  {
    return [
      'class_rate_id' => 'class rate',
      'subject_id' => 'subject',
      'classroom_id' => 'classroom'
    ];
  }
}
