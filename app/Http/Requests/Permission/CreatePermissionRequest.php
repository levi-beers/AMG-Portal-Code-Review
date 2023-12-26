<?php

namespace AMGPortal\Http\Requests\Permission;

use Illuminate\Validation\Rule;
use AMGPortal\Rules\ValidPermissionName;

class CreatePermissionRequest extends BasePermissionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                new ValidPermissionName,
                Rule::unique('permissions', 'name')
            ]
        ];
    }
}
