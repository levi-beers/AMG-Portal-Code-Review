<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataLendmarxSMSSubscriber extends FormRequest
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
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'phone' => 'required|string|unique:datalendmarxsms,phone',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'zip' => 'nullable',
            'email' => 'nullable',
            'dob' => 'nullable',
            'ip_address' => 'required|string',
            'gender' => 'nullable',
            'age' => 'nullable',
            'income' => 'nullable',
            'jornaya_lead_id' => 'nullable',
            'conditions' => 'nullable',
            'trustedform_cert_url' => 'nullable',
            'trustedform_token' => 'nullable',
            'tcpa_agent' => 'nullable',
            'insurance_amount' => 'nullable',
            'landing_page' => 'required|string',
            'lead_generated_date' => 'nullable',
            'lead_id' => 'nullable',
            'subid' => 'nullable',
            'subid2' => 'nullable',
            'subid3' => 'nullable',
            'subid4' => 'nullable',
            'subid5' => 'nullable'
        ];


        return $rules;
    }
}
