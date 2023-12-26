<?php

namespace AMGPortal\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Twilio\Rest\Client;
use AMGPortal\DataSource;

class DatabaseMonitor extends Command
{
    protected $signature = 'database:monitor';

    protected $description = 'Monitor the database table for no inserts in the past 5 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $datas = DataSource::where('datacheck', 1)->get();

        foreach ($datas as $data) {
            if (Schema::connection('mysql')->hasTable($data->datasource_table)) {
                $lastInserted = DB::table($data->datasource_table)->latest('created_at')->value('created_at');

                if (!$lastInserted || Carbon::parse($lastInserted)->lt(Carbon::now()->subHours(5))) {
                    $message = 'No insert in the past 5 hours to database table '.$data->datasource_table;
                    $recipients = '+639654013685';
                    $this->sendMessage($message, $recipients);
                } else {
                    $this->info('Database table has recent inserts.');
                }
            }
        }
    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }
}
