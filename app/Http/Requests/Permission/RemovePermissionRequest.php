<?php

namespace AMGPortal\Http\Requests\Permission;

use AMGPortal\Http\Requests\Request;

class RemovePermissionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('permission')->removable;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
