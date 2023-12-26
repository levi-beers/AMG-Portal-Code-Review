<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\LeadsCount;

class LeadsOutboundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $leadsData = LeadsCount::orderBy('date', 'ASC')->get();

        return view('outbound.index',[
            'leadsdata' => $leadsData,
            'user' => auth()->user()
        ]);
    }

}
