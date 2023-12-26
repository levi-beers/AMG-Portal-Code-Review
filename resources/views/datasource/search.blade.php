@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('styles')
    <style>
        tbody,
        tr {
            max-height: 300px;
            overflow-y: auto;
            display: block;
        }
    </style>
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('datasource.index') }}">Data Sources</a>
    </li>
    <li class="breadcrumb-item active">
        Search
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
                <h2>New Data Source Contact Search in "<span id="datatableName">{{ $datatablename->datasource_table }}</span>"</h2>
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <div class="col-md-3">
            <div class="form-group">
                <h5>@lang('From') <span class="text-danger">*</span></h5>
                <input type="datetime-local" name="dateFrom" id="dateFrom" value="" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>@lang('To') <span class="text-danger">*</span></h5>
                <input type="datetime-local" name="dateTo" id="dateTo" value="" class="form-control"
                    placeholder="Domain">
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="form-group">
                <h5>@lang('Select Filter')</h5>
                <select class="form-select form-control" aria-label="Default select example" id="selectFilter">
                    <option value="string" selected>Text</option>
                    <option value="bigint">Numeric</option>
                    <option value="behavioral">Behavioral</option>
                </select>
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-select form-control" aria-label="Default select example" id="selectFields">
                    <option selected>Select Field</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-select form-control " aria-label="Default select example" id="selectCondition">
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <input type="text" name="datasource_description" value="" class="form-control" id="valueSelected"
                    placeholder="[ Value ]">
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <button class="btn btn-primary btn-md" id="addButton">
                    @lang('Add')
                </button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h5>@lang('Combine Filter As')</h5>
                <select class="form-select form-control" aria-label="Default select example" id="selectedcombine">
                    <option value="AND">And</option>
                    <option value="OR">Or</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 selectedCriteria" style="margin-top: 30px;">
            <div class="pull-left mb-4">
                <h3>@lang('Selected criteria')</h3>
            </div>
            <hr>
            <table class="table table-borderless table-hover col-md-12" id="selectedCriteriaTable">
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="col-md-12" style="margin-top: 30px; margin-bottom: 20px;">
            <div class="pull-left mb-4">
                <h3>@lang('Select Output Fields')</h3>
            </div>
            <hr>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>@lang('Available Fields')</h5>
                <div class="card">
                    <div class="container mt-4">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover" id="availableFields">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group text-center">
                <h5>@lang('Including')</h5>
                <div class="btn-group col-md-8" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-info" id="addselectedFieldsRemove"><i
                            class="fas fa-caret-left"></i></button>
                    <button type="button" class="btn btn-info">Selected</button>
                    <button type="button" class="btn btn-info" id="addselectedFields"><i
                            class="fas fa-caret-right"></i></button>
                </div>
                <br><br>
                <div class="btn-group col-md-8" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-info" id="addselectedFieldsRemoveAll"><i
                            class="fas fa-caret-left"></i></button>
                    <button type="button" class="btn btn-info">All</button>
                    <button type="button" class="btn btn-info" id="addselectedFieldsAll"><i
                            class="fas fa-caret-right"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>@lang('Selected Fields')</h5>
                <div class="card">
                    <div class="container mt-4">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover" id="selectedTableFields">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12" style="margin-top: 30px; margin-bottom: 30px;"></div>

        <div class="col-md-12">
            <div class="form-group float-right">
                <button type="button" class="btn btn-info">Count</button>
                <button type="button" class="btn btn-primary">Generate multiple report</button>
                <button type="button" class="btn btn-success" id="generateViewReport">GENERATE AND VIEW REPORT</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('assets/js/as/datasource.js') }}"></script>
@stop
