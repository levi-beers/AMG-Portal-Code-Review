<?php

namespace AMGPortal\Console\Commands;

use Illuminate\Console\Command;
use AMGPortal\ContentSiteDeliverySettings;
use AMGPortal\DashboardData;
use AMGPortal\DataSource;
use AMGPortal\IOReport;
use AMGPortal\Leads;

class DashboardDataCount extends Command
{
    protected $signature = 'dashboard:datacount';

    protected $description = 'Dashboard Data Count';

    public function handle()
    {
        $totalDatasource = DataSource::count();
        $totalDataconnection = ContentSiteDeliverySettings::where('is_enabled', 1)->count();

        $totalOutboundDelta = Leads::whereDate('created_at', today()->subDays(1))
            ->count() - Leads::whereDate('created_at', today()->subDays(2))
            ->count();

        $totalOutboundYesterday = Leads::whereDate('created_at', today()->subDays(1))->count();
        $totalOutboundBeforeYesterday = Leads::whereDate('created_at', today()->subDays(2))->count();

        $totalInboundDelta = IOReport::whereDate('report_date', today()->subDays(1))
            ->sum('datacnt') - IOReport::whereDate('report_date', today()->subDays(2))
            ->sum('datacnt');

        $totalInboundYesterday = IOReport::whereDate('report_date', today()->subDays(1))->sum('datacnt');
        $totalInboundBeforeYesterday = IOReport::whereDate('report_date', today()->subDays(2))->sum('datacnt');

        $datadataboard = array(
            'total_datasource' => $totalDatasource,
            'total_data_connection' => $totalDataconnection,
            'total_outbound_delta' => $totalOutboundDelta,
            'total_inbound_delta' => $totalInboundDelta,
            'total_inbound_yesterday' => $totalInboundYesterday,
            'total_inbound_before_yesterday' => $totalInboundBeforeYesterday,
            'total_outbound_yesterday' => $totalOutboundYesterday,
            'total_outbound_before_yesterday' => $totalOutboundBeforeYesterday,
        );

        DashboardData::truncate();
        
        DashboardData::create($datadataboard);
    }
}
