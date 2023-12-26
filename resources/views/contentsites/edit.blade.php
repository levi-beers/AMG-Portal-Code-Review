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
	Edit
    </li>
@stop

@section('content')

@include('partials.messages')

    <div class="row">
    <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
                <h2>Edit Content Site</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('contentsites.index') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                    <i class="fas fa-arrow-alt-circle-left"></i> Back
                </button></a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('contentsites.update',$contentsite->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row mt-4 mb-4">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Site Name:</strong>
                    <input type="text" name="site_name" value="{{ $contentsite->site_name }}" class="form-control" placeholder="Site Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Domain:</strong>
                    <input type="text" readonly name="domain" value="{{ $contentsite->domain }}" class="form-control" placeholder="Domain">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>App Password:</strong>
                    <input type="text" name="app_password" value="{{ $contentsite->app_password }}" class="form-control" placeholder="Application Password">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <strong>Vertical ID:</strong>
                    {{ Form::select('vertical_id', $verticals, $contentsite->vertical_id, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
              <button type="submit" class="btn btn-lg rounded-0 btn-primary shadow-sm text-white">
                 Submit Changes <i class="fas fa-upload"></i>
                </button>
            </div>
        </div>
   
    </form>
@endsection