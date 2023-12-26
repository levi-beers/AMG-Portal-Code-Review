<?php

namespace AMGPortal\Http\Controllers\Web;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Mockery\Undefined;
use AMGPortal\DataSourceContactActivity;
use AMGPortal\DataSourceContactSearch;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\MailingResponders;

class DataSourceAnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contactData = DataSourceContactSearch::with('dataSource')
            ->get();

        return view('analytics.index', [
            'contactanalytics' => $contactData,
            'user' => auth()->user()
        ]);
    }

    public function show($id)
    {
        $contactDataActivity = DataSourceContactSearch::with('dataSource')->where('id', $id)->where('status', 1)->first();

        if ($contactDataActivity) {

            list($selectedCriteria, $dynamicFields2) = array_map('json_decode', [
                $contactDataActivity->selected_criteria,
                $contactDataActivity->selected_fields,
            ], array_fill(0, 2, true));

            $filterfields = array_map(function ($fieldDefinition) use ($contactDataActivity) {
                $parts = explode(':', $fieldDefinition);
                
                return count($parts) === 2 ? $contactDataActivity->dataSource->datasource_table . '.' . trim($parts[0]) : null;
            }, $dynamicFields2);

            $filterfields = array_filter($filterfields);

            $query = DB::table($contactDataActivity->dataSource->datasource_table);

            $combineFilter = $contactDataActivity->selected_combine === 'AND' ? 'where' : 'orWhere';

            $query->where(function ($query) use ($selectedCriteria, $contactDataActivity, $combineFilter) {

                $selectedCriteria = $selectedCriteria ?? [];

                $selectedCriteria = array_filter($selectedCriteria, function ($criteria) {
                    return !(in_array("opens", $criteria) || in_array("clicks", $criteria));
                });

                $query->$combineFilter($selectedCriteria);

                if ($contactDataActivity->date_from || $contactDataActivity->date_to) {
                    $query->whereBetween($contactDataActivity->dataSource->datasource_table . '.created_at', [
                        $contactDataActivity->date_from ?? '2000-01-01 00:00:00',
                        $contactDataActivity->date_to ?? now()->format('Y-m-d H:i:s')
                    ]);
                }
            });

            $selectedCriterias = $selectedCriteria ?? [];

            $selectedCriterias = array_filter($selectedCriterias, function ($criteria) {
                return (in_array("opens", $criteria) || in_array("clicks", $criteria));
            });

            if ($selectedCriterias) {
                $columnInfo = \DB::select(\DB::raw("SHOW COLUMNS FROM {$contactDataActivity->dataSource->datasource_table}"));

                $customFields = null;

                foreach ($columnInfo as $column) {
                    $columnFields = $column->Field;

                    if ($columnFields == 'email' || $columnFields == 'EmailAddress') {
                        $customFields = $columnFields;
                        break;
                    }
                }

                $query->join('mailing_responders', $contactDataActivity->dataSource->datasource_table . '.' . $customFields, '=', 'mailing_responders.email')
                    ->select(['mailing_responders.opens', 'mailing_responders.clicks', ...$filterfields]);

                foreach ($selectedCriterias as $condition) {
                    if (count($condition) === 3) {
                        list($column, $operator, $value) = $condition;
                        $query->$combineFilter('mailing_responders.' . $column, $operator, $value);
                    }
                }

                $dynamicFields2['clicks'] = 'clicks';
                $dynamicFields2['opens'] = 'opens';
            } else {
                $query->select(...$filterfields);
            }
            
            $datatables = $query->paginate(50);
        } else {
            return redirect()->route('analytics.contact')->with('success', 'Viewing of report is on process...');
        }

        return view('analytics.show', [
            'contactdataanalytics' => $contactDataActivity,
            'contactdataanalyticslist' => $datatables,
            'selectedFields' => $dynamicFields2,
            'user' => auth()->user()
        ]);
    }

    public function destroy($id)
    {
        DataSourceContactSearch::where('id', $id)->delete();

        DataSourceContactActivity::where('datasource_contact_search_id', $id)->delete();

        return redirect()->route('analytics.contact')->with('success', 'Contact activity deleted successfully');
    }

    public function exportCsv($id)
    {
        $contactDataActivity = DataSourceContactSearch::with('dataSource')->where('id', $id)->where('status', 1)->first();

        if ($contactDataActivity) {

            list($selectedCriteria, $dynamicFields2) = array_map('json_decode', [
                $contactDataActivity->selected_criteria,
                $contactDataActivity->selected_fields,
            ], array_fill(0, 2, true));

            $filterfields = array_map(function ($fieldDefinition) use ($contactDataActivity) {
                $parts = explode(':', $fieldDefinition);
                
                return count($parts) === 2 ? $contactDataActivity->dataSource->datasource_table . '.' . trim($parts[0]) : null;
            }, $dynamicFields2);

            $filterfields = array_filter($filterfields);

            $query = DB::table($contactDataActivity->dataSource->datasource_table);

            $combineFilter = $contactDataActivity->selected_combine === 'AND' ? 'where' : 'orWhere';

            $query->where(function ($query) use ($selectedCriteria, $contactDataActivity, $combineFilter) {

                $selectedCriteria = $selectedCriteria ?? [];

                $selectedCriteria = array_filter($selectedCriteria, function ($criteria) {
                    return !(in_array("opens", $criteria) || in_array("clicks", $criteria));
                });

                $query->$combineFilter($selectedCriteria);

                if ($contactDataActivity->date_from || $contactDataActivity->date_to) {
                    $query->whereBetween($contactDataActivity->dataSource->datasource_table . '.created_at', [
                        $contactDataActivity->date_from ?? '2000-01-01 00:00:00',
                        $contactDataActivity->date_to ?? now()->format('Y-m-d H:i:s')
                    ]);
                }
            });

            $selectedCriterias = $selectedCriteria ?? [];

            $selectedCriterias = array_filter($selectedCriterias, function ($criteria) {
                return (in_array("opens", $criteria) || in_array("clicks", $criteria));
            });

            if ($selectedCriterias) {
                $columnInfo = \DB::select(\DB::raw("SHOW COLUMNS FROM {$contactDataActivity->dataSource->datasource_table}"));

                $customFields = null;

                foreach ($columnInfo as $column) {
                    $columnFields = $column->Field;

                    if ($columnFields == 'email' || $columnFields == 'EmailAddress') {
                        $customFields = $columnFields;
                        break;
                    }
                }

                $query->join('mailing_responders', $contactDataActivity->dataSource->datasource_table . '.' . $customFields, '=', 'mailing_responders.email')
                    ->select(['mailing_responders.opens', 'mailing_responders.clicks', ...$filterfields]);

                foreach ($selectedCriterias as $condition) {
                    if (count($condition) === 3) {
                        list($column, $operator, $value) = $condition;
                        $query->$combineFilter('mailing_responders.' . $column, $operator, $value);
                    }
                }

                $dynamicFields2['clicks'] = 'clicks';
                $dynamicFields2['opens'] = 'opens';
            } else {
                $query->select(...$filterfields);
            }

            $exportResult = $query->get();

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=" . $contactDataActivity->dataSource->datasource_table . "-" . now()->format('mdY') . "-reportid_" . $contactDataActivity->id . ".csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0",
            );

            $tempFile = fopen('php://temp', 'w');

            $headerWritten = false;

            foreach ($exportResult as $row) {
                $rowArray = is_object($row) ? get_object_vars($row) : $row;

                if (!$headerWritten) {
                    fputcsv($tempFile, array_keys($rowArray));
                    $headerWritten = true;
                }

                fputcsv($tempFile, $rowArray);
            }


            rewind($tempFile);

            $response = new Response(stream_get_contents($tempFile), 200, $headers);

            fclose($tempFile);

            return $response;
        }
    }
}
