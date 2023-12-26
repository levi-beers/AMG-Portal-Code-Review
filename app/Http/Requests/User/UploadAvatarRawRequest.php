<?php

namespace AMGPortal\Http\Requests\User;

use AMGPortal\Http\Requests\Request;

class UploadAvatarRawRequest extends Request
{
    public function rules()
    {
        return [
            'file' => 'required|image'
        ];
    }
}
