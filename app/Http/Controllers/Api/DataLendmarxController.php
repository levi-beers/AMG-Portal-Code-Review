<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataLendmarxSubscriber;
use AMGPortal\Http\Resources\DataLendmarxResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataLendmarx;


class DataLendmarxController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataLendmarxSubscriber $request
     * @return UserResource
     */

    public function store(CreateNewDataLendmarxSubscriber $request)
    {
        //print "testtesttest";
        //var_dump('test goes here');
        $data = $request->only([
            'first_name', 'last_name', 'phone', 'address', 'city', 'state', 'zip', 'email', 'dob', 'ip_address', 'gender', 'age', 'income', 'jornaya_lead_id', 'conditions', 'trustedform_cert_url', 'trustedform_token', 'tcpa_agent', 'insurance_amount', 'landing_page', 'lead_generated_date', 'lead_id', 'subid', 'subid2', 'subid3', 'subid4', 'subid5', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);


//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataLendmarx::create($data);
        //error_log('Some message here.');
        //error_log(var_dump($user));

        return new DataLendmarxResource($user);

    }
}
