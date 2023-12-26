@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	<a href="{{ route('contentsitedeliverysettings.index') }}">Content Site Delivery Settings</a>
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
            <h2>Add New Content Site Delivery Setting</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('contentsitedeliverysettings.index') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
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

<form action="{{ route('contentsitedeliverysettings.store') }}" method="POST">
    @csrf

     <div class="row mt-4 mb-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Site Name:</strong>
                    {{ Form::select('content_site_id', $verticals, $options, ['class' => 'form-control']) }}
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Delivery Domain:</strong>
                    {!! Form::select('delivery_domain', ['Gmail' => 'Gmail','Microsoft' => 'Microsoft', 'Yahoo' => 'Yahoo', 'iCloud' => 'iCloud', 'Comcast' => 'Comcast', 'GI' => 'GI', 'SMS' => 'SMS'], $user ? $user : '',
                ['class' => 'form-control input-solid', 'id' => 'delivery_domain', '']) !!}
                </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                 <strong>DataSource:</strong>
                 {{ Form::select('datasource', $datalist, '', ['class' => 'form-control']) }}
             </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                 <strong>ESP List Setting:</strong>
                 {{ Form::select('esp_settings_id', $espsetting, '', ['class' => 'form-control']) }}
             </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Throttle:</strong>
                <input type="text" name="throttle" class="form-control" placeholder="Throttle">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Time Value:</strong>
                <select name="time_value" class="form-control">
                    <option value="day">Day</option>
                    <option value="minute">Minute</option>
                    <option value="hour">Hour</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Historic Throttle:</strong>
                    <input type="text" name="historic_throttle" class="form-control" placeholder="Historic Throttle">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Historic Time Value:</strong>
                    {!! Form::select('historic_time_value', ['day' => 'Day','hour' => 'Hour', 'minute' => 'Minute'], $user ? $user : '',
                ['class' => 'form-control input-solid', 'id' => 'historic_time_value', '']) !!}
                </div>
            </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
            <button type="submit" class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                 Add Content Site Delivery Setting <i class="fas fa-upload"></i>
            </button>
        </div>
    </div>

</form>
@endsection
