<?php

namespace AMGPortal\Http\Requests\Data;

use AMGPortal\Http\Requests\Request;

class CreateNewSubscriber extends Request
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

     //            'email', 'first_name', 'last_name', 'dob', 'address', 'city', 'region', 'zip', 'phone_mobile', 'email_signup_ip', 'email_signup_url', 'gender', 'timestamp'

    public function rules()
    {
        $rules = [
            'email' => 'required|email|unique:datasource2,email',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'region' => 'nullable',
            'zip' => 'nullable',
            'phone_mobile' => 'nullable',
            'email_signup_ip' => 'required|min:6',
            'email_signup_url' => 'required|min:6',
            'gender' => 'nullable',
            'timestamp' => 'required|min:6'
        ];

        return $rules;
    }
}
