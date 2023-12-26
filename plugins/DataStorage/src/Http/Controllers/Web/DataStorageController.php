<?php

namespace AMGPortal\DataStorage\Http\Controllers\Web;

use AMGPortal\Http\Controllers\Controller;

class DataStorageController extends Controller
{
    /**
     * Displays the plugin index page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('data-storage::index');
    }
}
