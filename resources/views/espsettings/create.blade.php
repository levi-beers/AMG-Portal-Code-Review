@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	<a href="{{ route('espsettings.index') }}">ESP List Settings</a>
    </li>
    <li class="breadcrumb-item active">
	Create
    </li>
@stop

@section('content')

@include('partials.messages')
<div class="row">
<div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
            <h2>Add New Data Connection for Alchemy Media Group</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('espsettings.index') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
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

<form action="{{ route('espsettings.store') }}" method="POST">
    @csrf

     <div class="row mt-4 mb-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ESP/Connection Name:</strong>
                    <input type="text" name="esp_name" class="form-control" placeholder="Sendinblue">
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ESP/Connection Description:</strong>
                    <input type="text" name="esp_description" class="form-control" placeholder="KN subaccount of master SIB">
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>List Name (optional):</strong>
                <input type="text" name="list_name" class="form-control" placeholder="Initial Gmail Roofing (Do Not Delete)">
             </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>List ID (optional):</strong>
                <input type="text" name="list_id" class="form-control" placeholder="23">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>API URL:</strong>
                <input type="text" name="api_url" class="form-control" placeholder="https://api.sendinblue.com/v3/contacts">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>API Key:</strong>
                    <input type="text" name="api_key" class="form-control" placeholder="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">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Used Email Marker (e.g. AJ):</strong>
                    <input type="text" name="esp_str_value" class="form-control" placeholder="AJ">
                </div>
            </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
            <button type="submit" class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                 Add Data Connection <i class="fas fa-upload"></i>
            </button>
        </div>
    </div>

</form>
@endsection
