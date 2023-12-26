<?php

namespace AMGPortal\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use AMGPortal\DataSource;
use AMGPortal\IOReport;

class IOReportMonitor extends Command
{
    protected $signature = 'ioreport:monitor';

    protected $description = 'Insert Daily report in every datasource';

    public function handle()
    {
        $datas = DataSource::where('datacheck', 1)->get();

        $result = [];

        foreach ($datas as $data) {
            if (Schema::connection('mysql')->hasTable($data->datasource_table)) {
                $queryResult =  DB::table($data->datasource_table)
                    ->select(
                        DB::raw('DATE(created_at) as report_date'),
                        DB::raw('COUNT(*) as count')
                    )
                    ->groupBy('report_date')
                    ->orderBy('report_date')
                    ->get();

                $result[$data->id] = $queryResult;
            }
        }

        foreach ($result as $dataId => $queryResult) {
            foreach ($queryResult as $resultItem) {

                $iodatastore = array(
                    'report_date' => $resultItem->report_date,
                    'datasource_id' => $dataId,
                    'datacnt' => $resultItem->count,
                    'reportType' => 'datacnt',
                );

                $checkdate = IOReport::where('report_date', $resultItem->report_date)->where('datasource_id', $dataId)->exists();

                if ($checkdate) {
                    $dataget = IOReport::where('report_date', $resultItem->report_date)->where('datasource_id', $dataId)->pluck('id');

                    $dataupdate = IOReport::where('id', $dataget)->first();

                    $dataupdate->report_date = $iodatastore['report_date'];
                    $dataupdate->datasource_id = $iodatastore['datasource_id'];
                    $dataupdate->datacnt = $iodatastore['datacnt'];
                    $dataupdate->reportType = $iodatastore['reportType'];
                    $dataupdate->save();
                } else {
                    IOReport::create($iodatastore);
                }
            }
        }
    }
}
