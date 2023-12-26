<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataJetSMSSubscriber extends FormRequest
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
            'phone_mobile' => 'required|string|unique:datajetsms,phone_mobile',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'mailing_address' => 'nullable',
            'city' => 'nullable',
            'region' => 'nullable',
            'zip' => 'nullable',
            'dob' => 'nullable',
            'gender' => 'nullable',
            'sms_optin' => 'nullable',
            'sms_signup_ip' => 'nullable',
            'sms_signup_url' => 'nullable',
            'sms_signup_tstamp' => 'nullable',
            'homeowner_status' => 'nullable',
            'employment_status' => 'nullable',
            'marital_status' => 'nullable',
            'education_level' => 'nullable'
        ];

        return $rules;
    }
}
