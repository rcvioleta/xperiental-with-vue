<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
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
            'student_id' => 'required|numeric',
            'credits' => 'required',
            'amount_paid' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'You must select a Student',
            'credits.required' => 'Please specify the number of credits you wish to add',
            'amount_paid.required' => 'Student must pay partial or full'
        ];
    }
}
