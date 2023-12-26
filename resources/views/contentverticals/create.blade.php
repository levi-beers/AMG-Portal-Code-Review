@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	<a href="{{ route('contentverticals.index') }}">Content Vertical Settings</a>
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
            <h2>Add New Vertical</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('contentverticals.index') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
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
   
<form action="{{ route('contentverticals.store') }}" method="POST">
    @csrf
  
    <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <label for="vertical_name">Vertical Name</label>
                    <input type="text" name="vertical_name" class="form-control" placeholder="Vertical Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-floating">
                    <label for="vertical_description">Vertical Description</label>
                    <textarea class="form-control" placeholder="Enter a description for this vertical" name="vertical_description" id="vertical_description" style="height: 100px"></textarea>
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