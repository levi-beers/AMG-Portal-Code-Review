@extends('layouts.app')

@section('page-title', __('Dashboard'))
@section('page-heading', __('Dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Dashboard')
</li>
@stop

@section('content')
@include('partials.messages')
<div class="row">
    <div class="col-md-12">
        <div class="datachart">
            <div class="card">
                <div class="date-filter card-header">
                    <div class="row my-3 flex-md-row flex-column-reverse">
                        <div class="col-md-4 mt-md-0 mt-2">
                            <div class="input-group">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> @lang('Back')</a>
                                
                            </div>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-2">
                            <div class="input-group">
                                <span class="input-group-append">@lang('From'): &nbsp;</span>
                                <input type="text" id="startdate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-2">
                            <div class="input-group">
                                <span class="input-group-append">@lang('To'): &nbsp;</span>
                                <input type="text" id="enddate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-md-0 mt-2">
                            <div class="input-group">
                                <button id="btnapplyFilter" class="btn btn-primary"><i class="fas fa-search text-muted"></i> @lang('Apply Filter')</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="pt-4 px-3">
                        <canvas id="datasourceChart" height="550"></canvas>
                        <!-- <div id="chartContainer"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ url('assets/js/chart.min.js') }}"></script>
<script src="{{ url('assets/js/chartjs-plugin-datasource.min.js') }}"></script>
<script src="{{ url('assets/js/as/datasourcefilter.js') }}"></script>
@stop