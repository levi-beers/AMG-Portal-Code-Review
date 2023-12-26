<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataJetS2SMSSubscriber extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'phone_mobile' => 'required|string|unique:datajets2sms,phone_mobile',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'dob' => 'nullable',
            'mailing_address' => 'nullable',
            'city' => 'nullable',
            'region' => 'nullable',
            'zip' => 'nullable',
            'member_id' => 'nullable',
            'sms_optin' => 'nullable',
            'sms_signup_ip' => 'nullable',
            'sms_signup_url' => 'nullable',
            'gender' => 'nullable',
            'homeowner_status' => 'nullable',
            'employment_status' => 'nullable',
            'marital_status' => 'nullable',
            'education_level' => 'nullable',
            'utm_campaign' => 'nullable',
            'utm_content' => 'nullable',
            'utm_medium' => 'nullable',
            'utm_term' => 'nullable',
            'utm_group' => 'nullable',
            'utm_source' => 'nullable'
        ];

        return $rules;
    }
}
