<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\ContentSite;
use AMGPortal\ContentVertical;
use AMGPortal\DataSource;
use AMGPortal\ESPSettings;
use AMGPortal\ContentSiteDeliverySettings;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;

class ContentSiteDeliverySettingsController extends Controller
{

    public function __construct(
        private UserRepository $users,
        private RoleRepository $roles,
        private CountryRepository $countries
    ) {
        // Allow access to authenticated users only.
        $this->middleware('auth');

        // Allow access to users with 'users.manage' permission.
        $this->middleware('permission:contentsite.view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$contentsites = ContentSite::latest()->paginate(5);
        //'contentsites' => $contentsites,
        //$contentsitedeliverysettings = ContentSiteDeliverySettings::get()->orderBy('content_site_id')->paginate(50);
        $contentsitedeliverysettings = ContentSiteDeliverySettings::orderBy('content_site_id', 'DESC')
                                                                            ->orderBy('esp_settings_id', 'DESC')
                                                                            ->get();
        //$contentsitedeliverysettings = ContentSiteDeliverySettings->orderBy('content_site_id')->paginate(15);

        $sitenames = ContentSite::pluck('site_name', 'id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });

        //$sitenames = ['' => __('All')] + $sitenames2;
        /*$sitenames = ['' => __('All')] + ContentSite::lists();*/

        return view('contentsitedeliverysettings.index', [
            'contentsitedeliverysettings' => $contentsitedeliverysettings,
            'sitenames' => $sitenames,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$verticals = ContentVertical::pluck('vertical_name','id')->map(function ($item, $key) {
        //    return "$item (ID:$key)";
        //});
        //$options = ContentVertical::where('id', 2)->pluck('vertical_name','id');

        $verticals = ContentSite::pluck('site_name', 'id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $options = ContentSite::where('id', 2)->pluck('site_name', 'id');
        /*$datalist = DataSource::pluck('datasource_table','id')->map(function ($item, $key) {
            return "($key) $item";
        });*/
        $datalist = DataSource::selectRaw("CONCAT_WS (' - ', datasource_table, datasource_description) as datasource_info, id")->pluck('datasource_info', 'id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });
        $espsetting = ESPSettings::selectRaw("CONCAT_WS (' - ', esp_name, esp_description, list_name) as esp_info, id")->pluck('esp_info', 'id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });

        Log::info($options);
        return view('contentsitedeliverysettings.create', [
            'user' => auth()->user(),
            'verticals' => $verticals,
            'options' => $options,
            'datalist' => $datalist,
            'espsetting' => $espsetting
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content_site_id' => 'required',
            'delivery_domain' => 'required',
            'datasource' => 'required',
            'esp_settings_id' => 'required',
            'throttle' => 'required',
            'time_value' => 'required',
            'historic_throttle' => 'required',
            'historic_time_value' => 'required'
        ]);

        ContentSiteDeliverySettings::create($request->all());

        return redirect()->route('contentsitedeliverysettings.index')
            ->with('success', 'Content Site Delivery Setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function show(ContentSite $contentsite)
    {
        Log::info("SHOW ContentSite: " . $contentsite->id);
        return view('contentsites.show', [
            'contentsite' => $contentsite,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentSiteDeliverySettings $contentsitedeliverysetting)
    {
        $select_id = $contentsitedeliverysetting->content_site_id;
        $verticals = ContentSite::pluck('site_name', 'id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $options = ContentSite::where('id', $select_id)->pluck('site_name', 'id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });


        $datalist_options = DataSource::where('id', $select_id)->selectRaw("CONCAT_WS (' - ', datasource_table, datasource_description) as datasource_info, id")->pluck('datasource_info', 'id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });
        /*$datalist = DataSource::pluck('datasource_table','id')->map(function ($item, $key) {
            return "($key) $item";
        });*/
        $datalist = DataSource::selectRaw("CONCAT_WS (' - ', datasource_table, datasource_description) as datasource_info, id")->pluck('datasource_info', 'id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });
        $espsetting = ESPSettings::selectRaw("CONCAT_WS (' - ', esp_name, esp_description, list_name) as esp_info, id")->pluck('esp_info', 'id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });

        Log::info('CONTENTSITEDELIVERYSETTINGS:' . $contentsitedeliverysetting);
        Log::info($select_id);
        Log::info($verticals);
        Log::info($options);
        return view('contentsitedeliverysettings.edit', [
            'contentsitedeliverysettings' => $contentsitedeliverysetting,
            'user' => auth()->user(),
            'verticals' => $verticals,
            'options' => $options,
            'datalist' => $datalist,
            'datalist_options' => $datalist_options,
            'espsetting' => $espsetting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentSiteDeliverySettings $contentsitedeliverysetting)
    {
        $request->validate([
            'content_site_id' => 'required',
            'delivery_domain' => 'required',
            'esp_settings_id' => 'required',
            'throttle' => 'required',
            'time_value' => 'required',
            'historic_throttle' => 'required',
            'historic_time_value' => 'required'
        ]);

        $contentsitedeliverysetting->update($request->except('datasource'));

        return redirect()->route('contentsitedeliverysettings.index')
            ->with('success', 'Content Site Delivery Settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentSiteDeliverySettings $contentsitedeliverysetting)
    {
        Log::info('CONTENT:' . $contentsitedeliverysetting);
        $contentsitedeliverysetting->delete();

        return redirect()->route('contentsitedeliverysettings.index')
            ->with('success', 'Content Site Delivery Setting deleted successfully');
    }
}
