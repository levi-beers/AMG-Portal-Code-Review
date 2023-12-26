<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\ContentSite;
use AMGPortal\ContentVertical;
use AMGPortal\DataSource;
use AMGPortal\ESPSettings;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;

class ESPSettingsController extends Controller
{

    public function __construct(
        private UserRepository $users,
        private RoleRepository $roles,
        private CountryRepository $countries)
    {
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
        //$contentsitedeliverysettings = ESPSettings::get()->orderBy('content_site_id')->paginate(50);
        $espsettings = ESPSettings::orderBy('esp_name', 'DESC')->get();
        //$contentsitedeliverysettings = ESPSettings->orderBy('content_site_id')->paginate(15);

        return view('espsettings.index',[
            'espsettings' => $espsettings,
            'user' => auth()->user()]);
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

        /*$verticals = ContentSite::pluck('site_name','id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $options = ContentSite::where('id', 2)->pluck('site_name','id');*/
        /*$datalist = DataSource::pluck('datasource_table','id')->map(function ($item, $key) {
            return "($key) $item";
        });*/
        /*$datalist = DataSource::selectRaw("CONCAT_WS (' - ', datasource_table, datasource_description) as datasource_info, id")->pluck('datasource_info','id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });*/

       // Log::info($options);
        return view('espsettings.create', [
            'user' => auth()->user()
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
            'esp_name' => 'required',
            'esp_description' => 'required',
            'list_name' => 'required',
            'list_id' => 'required',
            'api_url' => 'required',
            'api_key' => 'required',
            'esp_str_value' => 'required'
        ]);

        ESPSettings::create($request->all());

        return redirect()->route('espsettings.index')
                        ->with('success','ESP Setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function show(ContentSite $contentsite)
    {
        Log::info("SHOW ContentSite: ".$contentsite->id);
        return view('contentsites.show',[
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
    public function edit(ESPSettings $espsetting)
    {
       /*$select_id = $contentsitedeliverysetting->content_site_id;
        $verticals = ContentSite::pluck('site_name','id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $options = ContentSite::where('id', $select_id)->pluck('site_name','id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });


        $datalist_options = DataSource::where('id', $select_id)->selectRaw("CONCAT_WS (' - ', datasource_table, datasource_description) as datasource_info, id")->pluck('datasource_info','id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });
        $datalist = DataSource::selectRaw("CONCAT_WS (' - ', datasource_table, datasource_description) as datasource_info, id")->pluck('datasource_info','id')->map(function ($item, $key) {
            return "(ID:$key) $item";
        });

        Log::info('CONTENTSITEDELIVERYSETTINGS:'.$contentsitedeliverysetting);
        Log::info($select_id);
        Log::info($verticals);
        Log::info($options);*/
        return view('espsettings.edit',[
            'espsetting' => $espsetting,
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ESPSettings $espsetting)
    {
        $request->validate([
            'esp_name' => 'required',
            'esp_description' => 'required',
            'list_name' => 'required',
            'list_id' => 'required',
            'api_url' => 'required',
            'api_key' => 'required',
        ]);

        $espsetting->update($request->except('esp_str_value'));

        return redirect()->route('espsettings.index')
                        ->with('success','ESP Settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ESPSettings $espsetting)
    {
        Log::info('CONTENT:'.$espsetting);
        $espsetting->delete();

        return redirect()->route('espsettings.index')
                        ->with('success','ESP Setting deleted successfully');
    }
}
