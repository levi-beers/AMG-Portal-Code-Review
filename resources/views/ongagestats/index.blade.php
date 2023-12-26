@extends('layouts.app')

@section('page-title', __('Ongage Stats'))
@section('page-heading', __('Ongage Stats'))

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ url('assets/css/custom.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/datatables.min.css') }}">
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Ongage Stats')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="input-group col-md-6">
                    <span class="input-group-text"><i class="fas fa-filter"></i> Filter</span>
                    <form id="statusForm">
                        <select id="statusSelect" name="domain" class="form-control input-solid">
                            @foreach ($domainList as $list)
                                <option value="{{ $list }}">{{ $list }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            @if (empty($domainselected))
                @foreach ($domainList as $domainlists)
                    @if (!empty($domainlists))
                        <div class="row my-3 flex-md-row flex-column-reverse">
                            <div class="col-md-6">
                                <h1 class="font-weight-bold text-danger" id="displayDomain"
                                    style="text-transform: uppercase">{{ $domainlists }}</h1>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm example">
                                <thead>
                                    <tr>
                                        <th>@lang('GSR')</th>
                                        <th class="min-width-100">@lang('Day')</th>
                                        <th>@lang('Mailing Name')</th>
                                        <th>@lang('Sent')</th>
                                        <th>@lang('Success')</th>
                                        <th>@lang('Failed')</th>
                                        <th>@lang('Opens')</th>
                                        <th>@lang('Unsubscribes')</th>
                                        <th>@lang('Complaints')</th>
                                        <th>@lang('Clicks')</th>
                                        <th class="min-width-80">@lang('Open %')</th>
                                        <th class="min-width-80">@lang('Click %')</th>
                                        <th class="min-width-150">@lang('Unsubscribe %')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedDataByDate[$domainlists] as $date => $mgKnresults)
                                        @php
                                            $total_open = $dailyTotal[$domainlists]['opens'][$date];
                                            $total_clicks = $dailyTotal[$domainlists]['clicks'][$date];
                                            $total_unsubscribe = $dailyTotal[$domainlists]['unsubscribes'][$date];
                                            $total_success = $dailyTotal[$domainlists]['success'][$date];

                                            $open_percentage = $total_open != 0 && $total_success != 0 ? number_format(($total_open / $total_success) * 100, 2) : 0;
                                            $clicks_percentage = $total_clicks != 0 && $total_success != 0 ? number_format(($total_clicks / $total_success) * 100, 2) : 0;
                                            $unsubscribe_percentage = $total_unsubscribe != 0 && $total_success != 0 ? number_format(($total_unsubscribe / $total_success) * 100, 5) : 0;
                                        @endphp

                                        @foreach ($mgKnresults as $mgKnresult)
                                            <tr>
                                                <td>{{ $mgKnresult->gsr != 0 ? $mgKnresult->gsr : '' }}</td>
                                                <td>{{ $mgKnresult->day }}</td>
                                                <td>{{ $mgKnresult->mailing_name }}</td>
                                                <td>{{ $mgKnresult->sent }}</td>
                                                <td>{{ $mgKnresult->success }}</td>
                                                <td>{{ $mgKnresult->failed }}</td>
                                                <td>{{ $mgKnresult->opens }}</td>
                                                <td>{{ $mgKnresult->unsubscribes }}</td>
                                                <td>{{ $mgKnresult->complaints }}</td>
                                                <td>{{ $mgKnresult->clicks }}</td>
                                                <td>{{ $mgKnresult->opens_percent }}%</td>
                                                <td>{{ $mgKnresult->clicks_percent }}%</td>
                                                <td>{{ $mgKnresult->unsubscribes_percent == 0 ? 0 : $mgKnresult->unsubscribes_percent }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>{{ $mgKnresult->gsr != 0 ? $mgKnresult->gsr : '' }}</td>
                                            <td>{{ $date }}</td>
                                            <td class="h5">@lang('Total')</td>
                                            <td>{{ $dailyTotal[$domainlists]['sent'][$date] }}</td>
                                            <td>{{ $dailyTotal[$domainlists]['success'][$date] }}</td>
                                            <td>{{ $dailyTotal[$domainlists]['failed'][$date] }}</td>
                                            <td>{{ $dailyTotal[$domainlists]['opens'][$date] }}</td>
                                            <td>{{ $dailyTotal[$domainlists]['unsubscribes'][$date] }}</td>
                                            <td>{{ $dailyTotal[$domainlists]['complaints'][$date] }}</td>
                                            <td>{{ $dailyTotal[$domainlists]['clicks'][$date] }}</td>
                                            <td>{{ $open_percentage }}%</td>
                                            <td>{{ $clicks_percentage }}%</td>
                                            <td>{{ $unsubscribe_percentage }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-6">
                        <h1 class="font-weight-bold text-danger" id="displayDomain"></h1>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm example">
                        <thead>
                            <tr>
                                <th>@lang('GSR')</th>
                                <th class="min-width-100">@lang('Day')</th>
                                <th>@lang('Mailing Name')</th>
                                <th>@lang('Sent')</th>
                                <th>@lang('Success')</th>
                                <th>@lang('Failed')</th>
                                <th>@lang('Opens')</th>
                                <th>@lang('Unsubscribes')</th>
                                <th>@lang('Complaints')</th>
                                <th>@lang('Clicks')</th>
                                <th class="min-width-80">@lang('Open %')</th>
                                <th class="min-width-80">@lang('Click %')</th>
                                <th class="min-width-150">@lang('Unsubscribe %')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedDataByDate as $date => $mgKnresults)
                                @php
                                    $total_open = $dailyTotal['opens'][$date];
                                    $total_clicks = $dailyTotal['clicks'][$date];
                                    $total_unsubscribe = $dailyTotal['unsubscribes'][$date];
                                    $total_success = $dailyTotal['success'][$date];

                                    $open_percentage = $total_open != 0 && $total_success != 0 ? number_format(($total_open / $total_success) * 100, 2) : 0;
                                    $clicks_percentage = $total_clicks != 0 && $total_success != 0 ? number_format(($total_clicks / $total_success) * 100, 2) : 0;
                                    $unsubscribe_percentage = $total_unsubscribe != 0 && $total_success != 0 ? number_format(($total_unsubscribe / $total_success) * 100, 5) : 0;
                                @endphp
                                @foreach ($mgKnresults as $mgKnresult)
                                    <tr>
                                        <td>{{ $mgKnresult->gsr != 0 ? $mgKnresult->gsr : '' }}</td>
                                        <td>{{ $mgKnresult->day }}</td>
                                        <td>{{ $mgKnresult->mailing_name }}</td>
                                        <td>{{ $mgKnresult->sent }}</td>
                                        <td>{{ $mgKnresult->success }}</td>
                                        <td>{{ $mgKnresult->failed }}</td>
                                        <td>{{ $mgKnresult->opens }}</td>
                                        <td>{{ $mgKnresult->unsubscribes }}</td>
                                        <td>{{ $mgKnresult->complaints }}</td>
                                        <td>{{ $mgKnresult->clicks }}</td>
                                        <td>{{ $mgKnresult->opens_percent }}%</td>
                                        <td>{{ $mgKnresult->clicks_percent }}%</td>
                                        <td>{{ $mgKnresult->unsubscribes_percent == 0 ? 0 : $mgKnresult->unsubscribes_percent }}%
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>{{ $mgKnresult->gsr != 0 ? $mgKnresult->gsr : '' }}</td>
                                    <td>{{ $date }}</td>
                                    <td class="h5">@lang('Total')</td>
                                    <td>{{ $dailyTotal['sent'][$date] }}</td>
                                    <td>{{ $dailyTotal['success'][$date] }}</td>
                                    <td>{{ $dailyTotal['failed'][$date] }}</td>
                                    <td>{{ $dailyTotal['opens'][$date] }}</td>
                                    <td>{{ $dailyTotal['unsubscribes'][$date] }}</td>
                                    <td>{{ $dailyTotal['complaints'][$date] }}</td>
                                    <td>{{ $dailyTotal['clicks'][$date] }}</td>
                                    <td>{{ $open_percentage }}% </td>
                                    <td>{{ $clicks_percentage }}% </td>
                                    <td>{{ $unsubscribe_percentage }}% </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@stop

@section('scripts')
    <script src="{{ url('assets/js/datatables.min.js') }}"></script>
    <script>
        $('.example').dataTable({
            "searching": false,
            paging: false,
        });
    </script>
    <script src="{{ url('assets/js/as/ongage-stats.js') }}"></script>
@stop
