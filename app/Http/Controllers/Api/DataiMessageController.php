<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataiMessageSubscriber;
use AMGPortal\Http\Resources\DataiMessageResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataiMessage;

class DataiMessageController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataiMessageSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataiMessageSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url', 'stat', 'providerId', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataiMessage::create($data);

        return new DataiMessageResource($user);

    }
}
