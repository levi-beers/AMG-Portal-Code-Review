<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\ContentSite;
use AMGPortal\ContentVertical;
use AMGPortal\ContentSiteDeliverySettings;
use AMGPortal\DataSource;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use AMGPortal\DataSourceContactSearch;
use AMGPortal\Events\ContentSite\Added;
use AMGPortal\Events\User\LoggedOut;

class DataSourceController extends Controller
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
        //$users = User::orderBy('name', 'asc')->get();

        $dataSources = DataSource::orderBy('id', 'asc')->get()->sortBy(function ($data, $key) {
            return $data['datasource_table'];
        });

        return view('datasource.index', [
            'datasource' => $dataSources,
            'user' => auth()->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('datasource.create', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DataSource $datasource)
    {
        $request->validate([
            'datasource_table' => 'required',
            'datasource_description' => 'required',
            'datasource_acquired' => 'required'
        ]);

        DataSource::create($request->all());
        //event(new Added($datasource));

        return redirect()->route('datasource.index')
            ->with('success', 'Data Source created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \AMGPortal\DataSource  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function show(DataSource $datasource)
    {
        Log::info("SHOW DataSource: " . $datasource->id);
        return view('datasource.show', [
            'datasource' => $datasource,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AMGPortal\DataSource  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSource $datasource)
    {
        return view('datasource.edit', [
            'datasource' => $datasource,
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AMGPortal\DataSource  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataSource $datasource)
    {
        $request->validate([
            'datasource_table' => 'required',
            'datasource_description' => 'required',
            'datasource_acquired' => 'required',
        ]);

        $datasource->update($request->all());

        return redirect()->route('datasource.index')
            ->with('success', 'Data Source updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AMGPortal\DataSource  $contentSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSource $datasource)
    {
        $datasource->delete();

        return redirect()->route('datasource.index')
            ->with('success', 'Data Source removed from system record successfully.');
    }

    public function search($id)
    {

        $datatablename = DataSource::where('id', $id)->first();

        return view('datasource.search', [
            'datatablename' => $datatablename,
            'user' => auth()->user()
        ]);
    }

    public function getsearch(Request $request, $id)
    {
        $datatable = DataSource::where('id', $id)->first();

        $columnInfo = \DB::select(\DB::raw("SHOW COLUMNS FROM {$datatable->datasource_table}"));

        $selectedValue = $request->query('selectedvalue');
        $columnTypes = [];
        $columnAllTypes = [];

        foreach ($columnInfo as $column) {
            $columnName = $column->Field;
            $columnType = $column->Type;

            if (
                ($selectedValue === 'string' && (strpos($columnType, 'char') !== false || strpos($columnType, 'text') !== false)) ||
                ($selectedValue !== 'string' && (strpos($columnType, 'int') !== false))
            ) {
                $columnTypes[$columnName] = $columnType;
            }

            $columnAllTypes[$columnName] = $columnType;
        }

        return response()->json(['columntype' => $columnTypes, 'colunmalltype' => $columnAllTypes]);
    }

    public function postsearch(Request $request, $id)
    {
        $datefrom = $request->input('datefrom');
        $dateto = $request->input('dateto');
        $combinedata = $request->input('combinedata');
        $criteria = $request->input('datacriteria');
        $datafieldselected = $request->input('datafieldselected');

        $datatable = DataSource::where('id', $id)->first();

        $name = 'All Contact: ' . $datatable->datasource_table . ' | ' . $datatable->datasource_description . ' ';

        if ($criteria != null) {
            foreach ($criteria as $index => $condition) {
                list($column, $operator, $value) = $condition;

                $value = str_replace('%', '', $value);

                if ($index !== 0) {
                    $name .= ' ' . $combinedata . ' ';
                }
                if ($operator == '>=') {
                    $operator = "ANY";
                    $value = "";
                }
                $name .= "$column $operator $value";
            }
        }

        $data = array(
            'datasource_id' => $id,
            'name' => $name,
            'status' => 0,
            'count' => 0,
            'date_from' => $datefrom,
            'date_to' => $dateto,
            'selected_combine' => $combinedata,
            'selected_criteria' => json_encode($criteria),
            'selected_fields' => json_encode($datafieldselected),
        );

        $report = DataSourceContactSearch::create($data);

        if ($report) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to create the record']);
        }
    }
}
