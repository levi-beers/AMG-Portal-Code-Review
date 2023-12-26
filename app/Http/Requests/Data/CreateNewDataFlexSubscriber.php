<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataFlexSubscriber extends FormRequest
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
            'email' => 'required|string|unique:dataflex,email',
            'firstname' => 'required|string',
            'lastname' => 'nullable',
            'address' => 'nullable',
            'zip' => 'nullable',
            'city' => 'nullable',
            'state' => 'required|string',
            'phone' => 'required|string|unique:dataflex,phone',
            'dob' => 'nullable',
            'timestamp' => 'required|string',
            'ip' => 'required|string',
            'url' => 'required|string'
        ];

        return $rules;
    }
}
