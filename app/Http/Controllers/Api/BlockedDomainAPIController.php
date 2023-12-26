<?php

// working on  
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\ContentSiteDeliverySettings;
use AMGPortal\Http\Resources\ContentSiteDeliverySettingsResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataSource3;


class BlockedDomainAPIController extends Controller
{
    public function __construct()
    {

    }


    public function fetchDeliveryDomains(Request $request)
    {
        $data['delivery_domains'] = ContentSiteDeliverySettings::where("content_site_id", $request->content_site_id)
                                    ->get(["delivery_domain", "id"]);
                                      
        return response()->json($data);
    }

}
