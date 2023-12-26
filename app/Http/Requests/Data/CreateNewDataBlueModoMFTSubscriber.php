<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataBlueModoMFTSubscriber extends FormRequest
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
            'email' => 'required|string|unique:databluemodomft,email',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'address' => 'nullable',
            'zip' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'phone' => 'nullable',
            'dob' => 'nullable',
            'timestamp' => 'required|string',
            'ip' => 'required|string',
            'url' => 'required|string'
        ];

        return $rules;
    }
}
