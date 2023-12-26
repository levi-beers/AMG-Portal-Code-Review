<?php

namespace AMGPortal\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use AMGPortal\OngageStats as AMGPortalOngageStats;

class OngageStats extends Command
{

    protected $signature = 'ongage:stats';

    protected $description = 'Update ongage stats every 1 hour';

    public function handle()
    {
        $response = Http::withHeaders([
            'x_username' => 'levi@amgllc.io',
            'x_password' => 'Spket19162ab!',
            'x_account_code' => 'alchemy_media_group',
        ])->post('https://api.ongage.net/api/reports/query', [
            'select' => [
                'mailing_name',
                ['MAX(`stats_date`)', 'stats_date'],
                'sum(`sent`)',
                'sum(`success`)',
                'sum(`failed`)',
                'sum(`opens`)',
                'sum(`unique_opens`)',
                'sum(`unsubscribes`)',
                'sum(`complaints`)',
                'sum(`clicks`)',
                'sum(`unique_clicks`)',
            ],
            'from' => 'mailing',
            'group' => [
                'mailing_id',
                ['stats_date', 'day'],
            ],
            'order' => [
                ['stats_date', 'desc'],
            ],
            'filter' => [
                ['is_test_campaign', '=', 0],
                ['stats_date', '>=', '2023-10-01'],
            ],
            'calculate_rates' => true,
        ]);

        $data = $response->json();

        foreach ($data['payload'] as $record) {

            $mailing_domain = $this->mailingDomain($record['mailing_name']);
            $percentage = $record['unsubscribes_percent'];

            $percentage = ltrim($percentage, '0');
            $percentage = rtrim($percentage, '%');

            $decimal_places = strlen(substr(strrchr($percentage, "."), 1));

            if ($decimal_places <= 5) {
                $percentage = number_format((float)$percentage, 5, '.', '');
            }

            $records = [
                'day'               => $record['day'],
                'mailing_id'        => $record['mailing_id'],
                'mailing_name'      => $record['mailing_name'],
                'mailing_domain'    => $mailing_domain,
                'gsr'               => 0.00,
                'sent'              => $record['sent'],
                'success'           => $record['success'],
                'failed'            => $record['failed'],
                'opens'             => $record['opens'],
                'unsubscribes'      => $record['unsubscribes'],
                'complaints'        => $record['complaints'],
                'clicks'            => $record['clicks'],
                'opens_percent'     => str_replace("%", "", $record['opens_percent']),
                'clicks_percent'    => str_replace("%", "", $record['clicks_percent']),
                'unsubscribes_percent'  => $percentage,
                'created_at'        => now(),
                'updated_at'        => now()
            ];

            AMGPortalOngageStats::updateOrInsert(
                ['mailing_id' => $record['mailing_id']],
                $records
            );
        }
    }

    private function mailingDomain($mailingName)
    {
        $pattern = '';

        switch (true) {
            case preg_match('/news\.tff/', $mailingName):
                $pattern = 'news.tff';
                break;
            case preg_match('/news\.kn/', $mailingName):
                $pattern = 'news.kn';
                break;
            case preg_match('/mg\.kn/', $mailingName):
                $pattern = 'mg.kn';
                break;
            default:
                $pattern = 'unknown';
                break;
        }

        return $pattern;
    }
}
