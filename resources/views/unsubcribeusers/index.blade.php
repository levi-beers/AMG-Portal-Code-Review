@extends('layouts.app')

@section('page-title', __('Unsubscribe Users'))
@section('page-heading', __('Unsubscribe Users'))

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ url('assets/css/custom.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/datatables.min.css') }}">
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Unsubscribe Users')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control input-solid col-md-4" name="search" value=""
                                placeholder="@lang('Search...')">
                            <span class="input-group-append">
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('unsubscribe.create') }}" class="btn btn-primary btn-rounded float-right">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add')
                        </a>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="table-responsive" id="users-table-wrapper">
                    <table class="table table-bordered example">
                        <thead>
                            <tr>
                                <th>@lang('Email')</th>
                                <th>@lang('Domain')</th>
                                <th>@lang('OSRC')</th>
                                <th class="text-center" width="100px">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($result)
                                @foreach ($result as $data)
                                    <tr data-email="{{ $data->email }}" data-osrc="{{ $data->osrc }}">
                                        <td class="text">{{ $data->email }}</td>
                                        <td class="text">{{ $data->domain }}</td>
                                        <td class="text">{{ $data->osrc }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-icon delete-btn"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text text-center"><em>@lang('No records found.')</em></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('assets/js/datatables.min.js') }}"></script>
    <script>
        $('.example').dataTable({
            "searching": false,
            aaSorting: false
        });
    </script>
    <script src="{{ url('assets/js/as/unsubscribe.js') }}"></script>
@stop
