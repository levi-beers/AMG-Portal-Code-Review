<?php

namespace AMGPortal\Console\Commands;

use Illuminate\Console\Command;

class LeadsCount extends Command
{
    protected $signature = 'leads:count';

    protected $description = 'Leads Count';

    public function handle()
    {
        $this->call('db:seed', ['--class' => 'LeadCountsTableSeeder']);
    }
}
