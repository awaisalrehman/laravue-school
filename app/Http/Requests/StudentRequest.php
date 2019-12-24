<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
          'name' => 'required|string|between:3,255',
          'father_name' => 'required|string|between:3,255',
          'roll_no' => 'required|integer',
          'dob' => 'nullable|date',
          'gender' => 'nullable|integer|between:1,3',
          'cnic' => 'nullable|regex:[^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$]',
          'identification_mark' => 'nullable|string',
          'contact' => 'required|between:10,20|regex:[^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$]',
          'address' => 'required|string',
      ];
    }

    public function attributes()
    {
        return [
            'name' => 'Student Name',
            'father_name' => 'Father Name',
            'roll_no' => 'Roll No.',
            'dob' => 'Date of birth',
            'gender' => 'Gender',
            'cnic' => 'CNIC',
            'identification_mark' => 'Mark of identification',
            'contact' => 'Contact',
            'address' => 'Address',
        ];
    }
}
