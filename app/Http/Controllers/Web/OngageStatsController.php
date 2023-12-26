<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use AMGPortal\OngageStats;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Support\Enum\DomainList;

class OngageStatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $result = OngageStats::where('sent', '>=', 100)->orderBy('day', 'desc')->get();

        $filteredData = $result->filter(function ($item) {
            if (preg_match('/\[C] D: (.*?) \|/', $item->mailing_name, $matches)) {
                $domain = $matches[1];
                if (in_array($domain, ["news.kn", 'mg.kn', 'news.tff'])) {
                    return in_array($domain, ["news.kn", 'mg.kn', 'news.tff']);
                }
            } else {
                $domain = 'unknown';
            }
        });

        $groupedData = $filteredData->groupBy(function ($item) {
            preg_match('/\[C\] D: (.*?) \|/', $item->mailing_name, $matches);
            return $matches[1];
        });

        $mgKnData = $groupedData['mg.kn'] ?? collect();
        $newsKnData = $groupedData['news.kn'] ?? collect();
        $newsTffData = $groupedData['news.tff'] ?? collect();

        $groupedDataByDate = [
            'mg.kn' => $mgKnData->groupBy('day'),
            'news.kn' => $newsKnData->groupBy('day'),
            'news.tff' => $newsTffData->groupBy('day'),
        ];

        $tableName = (new OngageStats())->getTable();
        $columns = Schema::getColumnListing($tableName);

        $dailyTotal = array();
        foreach ($columns as $column) {
            foreach ($groupedDataByDate as $domain => $dataByDate) {
                $dailyTotal[$domain][$column] = $dataByDate->map(function ($items) use ($column) {
                    return $items->filter(function ($item) use ($column) {
                        return is_numeric($item->$column);
                    })->sum($column);
                });
            }
        }

        $domainList = ['empty' => __('')] + DomainList::lists();

        $domainselected = $request->domain;

        if (empty($domainselected)) {
            $groupedDataByDate = $groupedDataByDate;
            $dailyTotal = $dailyTotal;
        } else {
            $groupedDataByDate = $groupedDataByDate[$request->domain];
            $dailyTotal = $dailyTotal[$request->domain];
        }

        return view('ongagestats.index', compact('groupedDataByDate', 'dailyTotal', 'domainList', 'domainselected'));
    }
}
