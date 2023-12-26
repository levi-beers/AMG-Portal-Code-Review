<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\ContentSite;
use AMGPortal\ContentVertical;
use AMGPortal\ContentSiteDeliverySettings;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;
use AMGPortal\Events\ContentSite\Added;
use AMGPortal\Events\User\LoggedOut;

class ContentSitesController extends Controller
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
        $contentsites = ContentSite::latest()->get()->sortBy(function ($data, $key) {
            return $data['domain'];
        });
        
        return view('contentsites.index',[
            'contentsites' => $contentsites,
            'user' => auth()->user(),
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $verticals = ContentVertical::pluck('vertical_name','id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $options = ContentVertical::where('id', 2)->pluck('vertical_name','id');
        Log::info($options);

        return view('contentsites.create', [
            'user' => auth()->user(),
            'verticals' => $verticals,
            'options' => $options
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ContentSite $contentsite)
    {
        $request->validate([
            'domain' => 'required',
            'site_name' => 'required',
            'vertical_id' => 'required',
            'app_password' => 'required'
        ]);
      
        ContentSite::create($request->all());
        event(new Added($contentsite));
       
        return redirect()->route('contentsites.index')
                        ->with('success','Content Site created successfully.');
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
    public function edit(ContentSite $contentsite)
    {
        $verticals = ContentVertical::pluck('vertical_name','id')->map(function ($item, $key) {
            return "$item (ID:$key)";
        });
        $options = ContentVertical::where('id', 2)->pluck('vertical_name','id');
        Log::info($options);
        Log::info('CONTENT'.$contentsite);
        return view('contentsites.edit',[
            'contentsite' => $contentsite,
            'user' => auth()->user(),
            'verticals' => $verticals,
            'options' => $options
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentSite $contentsite)
    {
        $request->validate([
            'domain' => 'required',
            'site_name' => 'required',
            'vertical_id' => 'required',
            'app_password' => 'required'
        ]);
      
        $contentsite->update($request->all());
      
        return redirect()->route('contentsites.index')
                        ->with('success','Content Site updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AMGPortal\ContentSite  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentSite $contentsite)
    {
        $contentsite->delete();

        return redirect()->route('contentsites.index')
                        ->with('success','Content Site deleted successfully');
    }
}
