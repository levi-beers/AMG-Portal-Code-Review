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
        @lang('Contacts Activities')
    </li>
@stop

@section('content')

    @include('partials.messages')
    <div class="pull-left mb-4">
        <h2>@lang('Contacts Activities')</h2>
    </div>
    <div class="row my-3 flex-md-row flex-column-reverse">
        <div class="col-md-9">
        </div>
    </div>

    <div class="table-responsive">
        <table id="datatablerow" class="table table-bordered">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>DataSource Table</th>
                    <th width="350">Name</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Count</th>
                    <th width="200px">Action</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($contactanalytics as $contactanalyticslist)
                    <tr>
                        <td>{{ $contactanalyticslist->id }}</td>
                        <td>{{ $contactanalyticslist->dataSource->datasource_table }} |
                            {{ $contactanalyticslist->dataSource->datasource_description }}</td>
                        <td>{{ $contactanalyticslist->name }}</td>
                        <td>{{ $contactanalyticslist->created_at->format('d M y H:i') }}</td>
                        <td>{!! $contactanalyticslist->status == 1 ? "<span class='badge badge-lg badge-success'>Completed</span>" : "<span class='badge badge-lg badge-info'>Processing</span>" !!}</td>
                        <td>{{ $contactanalyticslist->count }}</td>
                        <td class="actions-width">
                            <form action="{{ route('analytics.delete', ['id' => $contactanalyticslist->id]) }}"
                                method="POST">
                                @permission('contentsite.manage')
                                    <a href="{{ route('analytics.view', $contactanalyticslist->id) }}"
                                        class="btn btn-md rounded-0 shadow-sm btn-primary text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endpermission
                                @permission('contentsite.delete')
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this Data Source Table {{ $contactanalyticslist->dataSource->datasource_table . ' | ' . $contactanalyticslist->dataSource->datasource_description }}?')"
                                        class="btn btn-md rounded-0 shadow-sm btn-danger">
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
