<?php

namespace AMGPortal\Http\Requests\Role;

use Illuminate\Validation\Rule;
use AMGPortal\Http\Requests\Request;
use AMGPortal\Permission;

class UpdateRolePermissionsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $permissions = Permission::pluck('id')->toArray();

        return [
            'permissions' => 'required|array',
            'permissions.*' => Rule::in($permissions)
        ];
    }

    public function messages()
    {
        return [
            'permissions.*' => 'Provided permission does not exist.'
        ];
    }
}
