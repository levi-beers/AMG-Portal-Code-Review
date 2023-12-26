<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataAttribitsSubscriber extends FormRequest
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
        'email' => 'required|string|unique:data_attribits,email',
        'first_name' => 'nullable',
        'last_name' => 'nullable',
        'address' => 'nullable',
        'city' => 'nullable',
        'state' => 'nullable',
        'zip' => 'nullable',
        'source_ip' => 'required|string',
        'source_url' => 'required|string',
        'source_dt' => 'nullable',
        'subid' => 'nullable',
        'year_born' => 'nullable',
        'gender' => 'nullable',
        'phone_number' => 'nullable',
        'credit_score' => 'nullable',
        'homeowner' => 'nullable',
        'veteran_flag' => 'nullable',
        'estimated_income' => 'nullable',
        'mariage_status' => 'nullable',
        'political_affiliation' => 'nullable',
        'presence_of_credit_card' => 'nullable'
        ];
        return $rules;
    }
}
