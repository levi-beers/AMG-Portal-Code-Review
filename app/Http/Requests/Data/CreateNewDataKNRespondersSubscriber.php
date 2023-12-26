<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataKNRespondersSubscriber extends FormRequest
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
            'email' => 'required|string|unique:dataknresponders,email',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'zip' => 'nullable',
            'source_ip' => 'required|string',
            'source_url' => 'required|string',
            'source_dt' => 'nullable',
            'year_born' => 'nullable',
            'subid' => 'nullable',
            'gender' => 'nullable',
            'phone_number' => 'nullable'
            ];
            return $rules;
    }
}
