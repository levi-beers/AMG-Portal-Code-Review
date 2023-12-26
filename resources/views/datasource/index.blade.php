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
        @lang('Data Sources')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="pull-left mb-4">
        <h2>Alchemy Media Group's Data Sources</h2>
    </div>
    <div class="row my-3 flex-md-row flex-column-reverse">
        <div class="col-md-9">
            @permission('contentsite.create')
                <a href="{{ route('datasource.create') }}"><button class="btn btn-lg rounded-0 shadow-sm"
                        style="background-color:#dbdbdb;">
                        <i class="fas fa-plus-square"></i> @lang('Add New Data Source')
                    </button></a>
            @endpermission
        </div>
    </div>
    <div class="table-responsive">
        <table id="datatablerow" class="table table-bordered">
            <thead>
                <tr>
                    <th>DataSource Table</th>
                    <th width="100px">DataSource ID</th>
                    <th>Description</th>
                    <th>Acquired Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datasource as $dataSource)
                    <tr>
                        <td>{{ $dataSource->datasource_table }}</td>
                        <td>{{ $dataSource->id }}</td>
                        <td>{{ $dataSource->datasource_description }}</td>
                        <td>{{ $dataSource->datasource_acquired }}</td>
                        <td class="col-md-3">
                            <form action="{{ route('datasource.destroy', $dataSource->id) }}" method="POST">
                                @permission('contentsite.manage')
                                    <a href="{{ route('datasource.edit', $dataSource->id) }}"
                                        class="btn btn-md rounded-0 shadow-sm btn-primary text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endpermission
                                @permission('contentsite.delete')
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this Data Source {{ $dataSource->datasource_table }}?')"
                                        class="btn btn-md rounded-0 shadow-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endpermission
                                @permission('contentsite.manage')
                                    <a href="{{ route('datasource.search', $dataSource->id) }}"
                                        class="btn btn-md rounded-0 shadow-sm btn-info text-white">
                                        <i class="fas fa-search"></i>
                                    </a>
                                @endpermission
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('assets/js/datatables.min.js') }}"></script>
    <script>
        new DataTable('#datatablerow');
    </script>
@stop
