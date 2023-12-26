@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/datatables.min.css') }}">
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item active">
        @lang('Contacts Activity')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="pull-left mb-4">
        <h2>@lang('Contacts Activity')</h2>
    </div>
    <div class="row my-3 flex-md-row flex-column-reverse">
        <div class="col-md-12">
            <br>
            <h3>@lang('Applied Rules')</h3>
            <hr>
            <p class="display-title">All data filtered from <strong>{{ $contactdataanalytics->date_from }}</strong> to
                <strong>{{ $contactdataanalytics->date_to }}</strong>
            </p>
            <p class="display-title">{{ $contactdataanalytics->name }}</p>

            <a class="btn btn-primary float-right" href="{{ route('analytics.export', $contactdataanalytics->id ) }}">@lang('Export Combined Detailed Report')</a>
        </div>
    </div>

    <div class="table-responsive">  
        <table id="datatablerow" class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($selectedFields as $headerfields)
                        @php
                            $parts = explode(':', $headerfields);

                        @endphp
                        <th>{{ trim($parts[0]) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($contactdataanalyticslist as $contactanalyticslist)
                    <tr>
                        @foreach ($selectedFields as $headerfieldss)
                            @php
                                $parts = explode(':', $headerfieldss);
                            @endphp
                            <td>{{ $contactanalyticslist->{trim($parts[0])} }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>

    {{ $contactdataanalyticslist->links() }}

    <br>
@endsection

@section('scripts')
    <script src="{{ url('assets/js/datatables.min.js') }}"></script>
@stop
