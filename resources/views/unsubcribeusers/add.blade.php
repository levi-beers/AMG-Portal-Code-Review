@extends('layouts.app')

@section('page-title', __('Add Unsubscribe Users'))
@section('page-heading', __('Create Unsubscribe Users'))

@section('breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('unsubscribe') }}">@lang('Unsubscribe Users')</a>
</li>
<li class="breadcrumb-item active">
    @lang('Create')
</li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">
        <form action="{{ route('unsubscribe.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('unsubscribe') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-alt-circle-left"></i>
                        @lang('Back')
                    </a>
                </div>
                <br><br>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">@lang('Email')</label>
                        <textarea class="form-control input-solid" id="email" name="email" rows="10" cols="50">{{ old('email') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="file" name="file" class="btn btn-secondary">

                    <button type="submit" class="btn btn-primary float-right">
                        @lang('Save')
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<br>
@stop

@section('scripts')
{!! HTML::script('assets/js/as/profile.js') !!}
{!! JsValidator::formRequest('AMGPortal\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop