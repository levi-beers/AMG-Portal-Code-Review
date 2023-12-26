<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\ContentVertical;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;

class ContentVerticalsController extends Controller
{
    public function __construct(
        private UserRepository $users,
        private RoleRepository $roles,
        private CountryRepository $countries)
    {
        // Allow access to authenticated users only.
        $this->middleware('auth');

        // Allow access to users with 'users.manage' permission.
        $this->middleware('permission:contentsite.manage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentverticals = ContentVertical::latest()->paginate(50);
        return view('contentverticals.index',[
            'contentverticals' => $contentverticals,
            'user' => auth()->user(),
        ])->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        return view('contentverticals.create', [
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
            'vertical_name' => 'required',
        ]);

        ContentVertical::create($request->all());

        return redirect()->route('contentverticals.index')
                        ->with('success','Content Site created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \AMGPortal\ContentVertical  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function show(ContentVertical $contentvertical)
    {
        Log::info("SHOW ContentVertical: ".$contentvertical->id);
        return view('contentverticals.show',[
            'contentvertical' => $contentvertical,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AMGPortal\ContentVertical  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentVertical $contentvertical)
    {
        return view('contentverticals.edit',[
            'contentvertical' => $contentvertical,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AMGPortal\ContentVertical  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentVertical $contentvertical)
    {
        $request->validate([
            'vertical_name' => 'required',
            'vertical_description' => 'required',
        ]);

        $contentvertical->update($request->all());

        return redirect()->route('contentverticals.index')
                        ->with('success','Content Site updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AMGPortal\ContentVertical  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentVertical $contentvertical)
    {
        $contentvertical->delete();

        return redirect()->route('contentverticals.index')
                        ->with('success','Content Site deleted successfully');
    }
}
