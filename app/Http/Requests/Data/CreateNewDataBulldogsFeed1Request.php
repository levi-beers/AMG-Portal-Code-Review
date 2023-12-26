<?php

namespace AMGPortal\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewDataBulldogsFeed1Request extends FormRequest
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
        return [
            'email' => 'required|string|unique:databulldogs_feed1,email',
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'address' => 'nullable|string',
            'zip' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'phone' => 'nullable|string',
            'dob' => 'nullable|date',
            'timestamp' => 'nullable|date',
            'ip' => 'nullable|string',
            'url' => 'nullable|string',
            // Add additional fields and rules as necessary
        ];
    }
}
