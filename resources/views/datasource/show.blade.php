@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
<li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	<a href="{{ route('contentsites.index') }}">DataSources</a>
    </li>
    <li class="breadcrumb-item active">
	Showing {{ $datasource->datasource_table }}
    </li>
@stop

@section('content')

@include('partials.messages')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show DataSource</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contentsites.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>DataSource Table:</strong>
                {{ $datasource->datasource_table }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>DataSource Description:</strong>
                {{ $datasource->datasource_description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>DataSource Added:</strong>
                {{ $datasource->datasouce_added }}
            </div>
        </div>
    </div>
@endsection
