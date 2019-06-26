<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
            // 'image' => 'required',
            'first_name' => 'required|string',
            // 'middle_name' => 'string',
            'last_name' => 'required|string',
            // 'position' => 'required|string',
            // 'gender' => 'required|string',
            'bday' => 'required|string|date_format:Y-m-d',
            // 'contact_num' => 'required',
            // 'address' => 'required|string',
            'hired_date' => 'required|string|date_format:Y-m-d',
            'status' => 'required|max:1|digits:1'
        ];
    }

    public function messages()
    {
        return [
            'id_num.required' => 'ID Number is required',
            // 'image.required' => 'Profile picture is required',
            // 'gender.required' => 'Gender must be chosen',
            // 'contact_num.required' => 'Contact number is required',
            'bday.required' => 'Birth date is required'
        ];
    }
}
