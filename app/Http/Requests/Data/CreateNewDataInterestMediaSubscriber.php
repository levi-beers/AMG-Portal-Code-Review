<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CreateNewDataInterestMediaSubscriber extends FormRequest
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

    /*public function withValidator(Validator $validator)
    {
        $email = $validator->getData()['user_email_address'] ?? '';

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            var_dump('Validation Failed.');
        }

        $validator->after(
            function ($validator) use ($email) {
                    $validator->errors()->add(
                       'user_email_address',
                       'This email does not exist on our pre-approved email list'
                    );
            }
         );
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function rules()
    {
        $rules = [
            'created_on' => 'nullable',
            'user_email_address' => 'required|email|unique:datainterestmedia,user_email_address',
            'user_mobile' => 'required|string|unique:datainterestmedia,user_mobile',
            'user_first_name' => 'nullable',
            'user_last_name' => 'nullable',
            'user_address' => 'nullable',
            'user_city_name' => 'nullable',
            'user_state_code' => 'nullable',
            'user_zip_code' => 'nullable',
            'user_dob' => 'nullable',
            'user_gender' => 'nullable',
            'user_age' => 'nullable',
            'is_optin' => 'nullable',
            'ip_address' => 'nullable',
            'trusterd_form_cert_url' => 'nullable',
            'domain_name' => 'nullable'
        ];


        return $rules;
    }
}
