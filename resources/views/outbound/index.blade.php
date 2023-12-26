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
        @lang('Outbound')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="pull-left mb-4">
        <h2>@lang('Outbound')</h2>
    </div>
    <div class="row my-3 flex-md-row flex-column-reverse">
        <div class="col-md-9">
        </div>
    </div>

    <div class="table-responsive">
        <table id="datatablerow" class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>ESP ID</th>
                    <th>Datasource ID</th>
                    <th>Description</th>
                    <th>ESP Name</th>
                    <th>ESP Description</th>
                    <th>Lead Count</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($leadsdata as $data)
                    <tr>
                        <td>{{ $data->date }}</td>
                        <td>{{ $data->esp_id}}</td>
                        <td>{{ $data->datasource_id }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->esp_name }}</td>
                        <td>{{ $data->esp_description }}</td>
                        <td>{{ $data->lead_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('assets/js/datatables.min.js') }}"></script>
    <script>
        new DataTable('#datatablerow', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@stop
