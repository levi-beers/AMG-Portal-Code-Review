@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	<a href="{{ route('datasource.index') }}">DataSource Create</a>
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
            <h2>Add New Data Source</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('datasource.index') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
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

<form action="{{ route('datasource.store') }}" method="POST">
    @csrf

     <div class="row mt-4 mb-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>DataSource Table:</strong>
                    <input type="text" name="datasource_table" class="form-control" placeholder="datasouce7">
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>DataSource Description:</strong>
                <input type="text" name="datasource_description" class="form-control" placeholder="SuCo Refinance">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>DataSource Acquired:</strong>
                    <input type="text" name="datasource_acquired" class="form-control" placeholder="YYYY-MM-DD">
                </div>
            </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
            <button type="submit" class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                 Add Data Source <i class="fas fa-database"></i>
            </button>
        </div>
    </div>

</form>
@endsection
