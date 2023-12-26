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
        @lang('Data Connections')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="pull-left mb-4">
        <h2>Alchemy Media Group's Data Connections</h2>
    </div>
    <div class="row my-3 flex-md-row flex-column-reverse">
        <div class="col-md-9">
            @permission('contentsite.create')
                <a href="{{ route('espsettings.create') }}"><button class="btn btn-lg rounded-0 shadow-sm"
                        style="background-color:#dbdbdb;">
                        <i class="fas fa-plus-square"></i> @lang('Add New Data Connection')
                    </button></a>
            @endpermission
        </div>
    </div>
    <div class="table-responsive">
        <table id="datatablerow" class="table table-bordered">
            <thead>
                <tr>
                    <th>ESP Name</th>
                    <th>ESP Description</th>
                    <th>List Name</th>
                    <th>List ID</th>
                    <th>API URL</th>
                    <th width="200px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($espsettings as $ESPSetting)
                    <tr>
                        <td>{{ $ESPSetting->esp_name }}</td>
                        <td>{{ $ESPSetting->esp_description }}</td>
                        <td style="overflow-wrap: break-word;
                        max-width: 100px;">{{ $ESPSetting->list_name }}</td>
                        <td>{{ $ESPSetting->list_id }}</td>
                        <td style="overflow-wrap: break-word;
                        max-width: 300px;">{{ $ESPSetting->api_url }}</td>
                        <td class="actions-width" style="width: 280px;">
                            <form action="{{ route('espsettings.destroy', $ESPSetting->id) }}" method="POST">
                                @permission('contentsite.manage')
                                    <a href="{{ route('espsettings.edit', $ESPSetting->id) }}"
                                        class="btn rounded-0 shadow-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endpermission
                                @permission('contentsite.delete')
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this Data Connection for {{ $ESPSetting->esp_name }} | {{ $ESPSetting->esp_description }} to API {{ $ESPSetting->api_url }} ?')"
                                        class="btn rounded-0 shadow-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endpermission
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br>
@endsection

@section('scripts')
    <script src="{{ url('assets/js/datatables.min.js') }}"></script>
    <script>
        new DataTable('#datatablerow');
    </script>
@stop
