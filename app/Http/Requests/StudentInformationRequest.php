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
      'address' => 'required',
      'emcon_full_name' => 'required',
      'emcon_phone_number' => 'required',
      'emcon_relationship' => 'required',
      'emcon_address' => 'required'
    ];
  }

  public function messages()
  {
    return [
      'id_num.required' => 'Student ID field is required',
      'gender.required' => 'Gender is required',
      'birth_date.required' => 'Birthdate is required',
      'phone_number.required' => 'Phone number is required',
      'emcon_full_name.required' => 'Full name of emergency contact is needed',
      'emcon_phone_number.required' => 'Phone number is required',
      'emcon_relationship.required' => 'Relationship is required',
      'emcon_address.required' => 'The address field is required'
    ];
  }
}
