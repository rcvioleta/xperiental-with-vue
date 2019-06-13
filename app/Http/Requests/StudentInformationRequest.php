<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentInformationRequest extends FormRequest
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
      'id_num' => 'required',
      'first_name' => 'required',
      'middle_name' => 'required',
      'last_name' => 'required',
      'gender' => 'required',
      'birth_date' => 'required',
      'phone_number' => 'required|integer',
      'address' => 'required'
    ];
  }
}
