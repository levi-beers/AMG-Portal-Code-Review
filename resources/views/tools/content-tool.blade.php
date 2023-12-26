@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item active">
	Content Tool
    </li>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'content-tool.search', 'id' => 'search-form']) !!}

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">@lang('Search Term')</label>
                    <input type="text" class="form-control input-solid" id="search_term"
                           name="search_term">
                </div>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-lg rounded-0 shadow-sm" type="submit" style="background-color:#dbdbdb;">
                <i class="fab fa-searchengin"></i> @lang('Perform Search')
            </button>

{{ Form::close() }}
@stop
