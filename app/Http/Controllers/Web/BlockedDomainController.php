<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\ContentSite;
use AMGPortal\ContentVertical;
use AMGPortal\ContentSiteDeliverySettings;
use AMGPortal\BlockedDomain;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;

class BlockedDomainController extends Controller
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
        $blockedDomains = BlockedDomain::latest()->paginate(5);
        
        return view('blockeddomains.index',[
            'blockeddomains' => $blockedDomains,
            'user' => auth()->user(),
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ContentSite $contentsite)
    {

        //$verticals = ContentVertical::pluck('vertical_name','id')->map(function ($item, $key) {
        //    return "$item (ID:$key)";
        //});
        //$options = ContentVertical::where('id', 2)->pluck('vertical_name','id');

        $select_contentsite = ContentSite::pluck('site_name','id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $data['contentsites'] = ContentSite::get(["site_name", "id"]);
        $options = ContentSite::where('id', 2)->pluck('site_name','id');
        $contentsitedeliverysettings = ContentSiteDeliverySettings::latest()->paginate(5);
        $contentsites = ContentSite::latest()->get();

        Log::info('printcheck');
        Log::info($select_contentsite);
        return view('blockeddomains.create', [
            'user' => auth()->user(),
            'contentsitedeliverysettings' => $contentsitedeliverysettings,
            'contentsites' => $contentsites,
            'select_contentsite' => $select_contentsite,
            'data' => $data,
            'options' => $options
        ]);
    }


        public function fetchDeliveryDomains(Request $request)
        {
            $data['delivery_domains'] = ContentSiteDeliverySettings::where("content_site_id", $request->content_site_id)
                                        ->get(["name", "id"]);
                                          
            return response()->json($data);
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
            'delivery_id' => 'required',
            'domain' => 'required'
        ]);
      
        BlockedDomain::create($request->all());
       
        return redirect()->route('blockeddomains.index')
                        ->with('success','Added blocked domain to list.');
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
    public function edit(BlockedDomain $blockeddomain)
    {
        $content_site_id = $blockeddomain->content_site_id;
        $delivery_id = $blockeddomain->delivery_id;

        $contentsitedeliverysettings = ContentSiteDeliverySettings::where("content_site_id", $content_site_id)->get();
        $contentsites = ContentSite::latest()->get();


        Log::info('CONTENTSITEDELIVERYSETTINGS:'.$contentsitedeliverysettings);

        return view('blockeddomains.edit',[
            'contentsitedeliverysettings' => $contentsitedeliverysettings,
            'content_site_id' => $content_site_id,
            'delivery_id' => $delivery_id,
            'blockeddomain' => $blockeddomain,
            'contentsites' => $contentsites,
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
    public function update(Request $request, BlockedDomain $blockeddomain)
    {
        $request->validate([
            'content_site_id' => 'required',
            'delivery_id' => 'required',
            'domain' => 'required'
        ]);
      
        $blockeddomain->update($request->all());
      
        return redirect()->route('blockeddomains.index')
                        ->with('success','Blocked Domain updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlockedDomain $blockeddomain)
    {
        Log::info('CONTENT:'.$blockeddomain);
        $blockeddomain->delete();
       
        return redirect()->route('blockeddomains.index')
                        ->with('success','Removed blocked domain successfully.');
    }
}
