<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataR1DMultiSubscriber extends FormRequest
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
        $rules = [
            'email' => 'required|string|unique:datar1dmulti,email',
            'fname' => 'required|string',
            'lname' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'required|string',
            'zip' => 'nullable',
            'phone' => 'required|string|unique:datar1dmulti,phone',
            'url' => 'required|string',
            'ip' => 'required|string',
            'datestamp' => 'nullable',
            'leadid' => 'nullable'
        ];

        return $rules;
    }
}
