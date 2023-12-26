@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
<li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	<a href="{{ route('contentsites.index') }}">Content Site Settings</a>
    </li>
    <li class="breadcrumb-item active">
	Showing {{ $contentsite->domain }}
    </li>
@stop

@section('content')

@include('partials.messages')
  
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Content site</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contentsites.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Domain:</strong>
                {{ $contentsite->domain }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Throttle:</strong>
                {{ $contentsite->throttle }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Time Value:</strong>
                {{ $contentsite->time_value }}
            </div>
        </div>
    </div>
@endsection