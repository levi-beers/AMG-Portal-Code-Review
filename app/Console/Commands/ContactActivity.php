<?php

namespace AMGPortal\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use AMGPortal\DataSourceContactSearch;
use AMGPortal\MailingResponders;

class ContactActivity extends Command
{

    protected $signature = 'contact:activity';

    protected $description = 'Contact Activity';

    public function handle()
    {
        $this->info('Processing...');

        $contactDataActivity = DataSourceContactSearch::with('dataSource')->where('status', 0)->first();

        if ($contactDataActivity) {

            if (Schema::connection('mysql')->hasTable($contactDataActivity->dataSource->datasource_table)) {
                $selectedCriteria = json_decode($contactDataActivity->selected_criteria, true);
                $dynamicFields2 = json_decode($contactDataActivity->selected_fields, true);

                $filterfields = array_map(function ($fieldDefinition) use ($contactDataActivity) {
                    $parts = explode(':', $fieldDefinition);
                    
                    return count($parts) === 2 ? $contactDataActivity->dataSource->datasource_table . '.' . trim($parts[0]) : null;
                }, $dynamicFields2);

                $filterfields = array_filter($filterfields);

                DB::beginTransaction();

                try {
                    $query = DB::table($contactDataActivity->dataSource->datasource_table);

                    $query->select(...$filterfields);

                    $query->where(function ($query) use ($selectedCriteria, $contactDataActivity) {

                        $combineFilter = $contactDataActivity->selected_combine === 'AND' ? 'where' : 'orWhere';

                        $selectedCriteria = $selectedCriteria ?? [];

                        $selectedCriteria = array_filter($selectedCriteria, function ($criteria) {
                            return !(in_array("opens", $criteria) || in_array("clicks", $criteria));
                        });

                        $query->$combineFilter($selectedCriteria);

                        if ($contactDataActivity->date_from || $contactDataActivity->date_to) {
                            $query->whereBetween('created_at', [
                                $contactDataActivity->date_from ?? '2000-01-01 00:00:00',
                                $contactDataActivity->date_to ?? now()->format('Y-m-d H:i:s')
                            ]);
                        }
                    });

                    $selectedCriterias = $selectedCriteria ?? [];

                    $selectedCriterias = array_filter($selectedCriterias, function ($criteria) {
                        return (in_array("opens", $criteria) || in_array("clicks", $criteria));
                    });

                    $queryResult = $query->get();

                    if ($selectedCriterias) {
                        $mailing = new MailingResponders();
                        $result = $mailing->getEmailsForCampaign($selectedCriterias);

                        $columnInfo = \DB::select(\DB::raw("SHOW COLUMNS FROM {$contactDataActivity->dataSource->datasource_table}"));
                        
                        $customFields = null;

                        foreach ($columnInfo as $column) {
                            $columnFields = $column->Field;

                            if ($columnFields == 'email' || $columnFields == 'EmailAddress') {
                                $customFields = $columnFields;
                                break;
                            }
                        }
                        
                        $nonBehavioralEmails = collect($queryResult)->pluck($customFields)->unique()->toArray();

                        $matchingData = $result->filter(function ($behavioralData) use ($nonBehavioralEmails) {
                            return in_array($behavioralData->email, $nonBehavioralEmails);
                        });

                        $totalcount = $matchingData->count();
                    } else {
                        $totalcount = $queryResult->count();
                    }

                    DataSourceContactSearch::where('id', $contactDataActivity->id)->update(['status' => 1, 'count' => $totalcount]);

                    DB::commit();

                    $this->info('Success..');
                } catch (\Exception $e) {
                    DB::rollback();

                    dd($e->getMessage());
                }
            } else {

                DataSourceContactSearch::where('id', $contactDataActivity->id)->update(['status' => 1, 'count' => 0]);
                $this->info("Table not exist in the 'mysql' connection.");
            }
        } else {
            $this->info('No data found.');
            return false;
        }
    }
}
