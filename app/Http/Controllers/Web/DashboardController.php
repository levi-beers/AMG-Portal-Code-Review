<?php

namespace AMGPortal\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use AMGPortal\DataSource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\IOReport;
use Illuminate\Http\Request;
use AMGPortal\DashboardData;

class DashboardController extends Controller
{
    /**
     * Displays the application dashboard.
     *
     * @return Factory|View
     */
    public function index()
    {
        if (session()->has('verified')) {
            session()->flash('success', __('E-Mail verified successfully.'));
        }
        
        return view('dashboard.index');
    }

    public function show()
    {
        $data = IOReport::with('dataSource')->orderBy('report_date')->get();

        return response()->json($data);
    }

    public function showfilter(Request $request, $id)
    {
        if ($request->ajax()) {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');

            $data = IOReport::with('datasource')
                ->where('datasource_id', $id)
                ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                    return $query->whereDate('report_date', '>=', $startDate)->whereDate('report_date', '<=', $endDate);
                })
                ->whereYear('report_date', Carbon::now()->year)
                ->orderBy('report_date')
                ->get();

            return response()->json($data);
        }

        return view('dashboard.filterdata');
    }
}
