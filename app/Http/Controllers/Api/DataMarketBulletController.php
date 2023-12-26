<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataMarketBulletSubscriber;
use AMGPortal\Http\Resources\DataMarketBulletResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataMarketBullet;


class DataMarketBulletController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataMarketBulletSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataMarketBulletSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataMarketBullet::create($data);

        return new DataMarketBulletResource($user);

    }
}
