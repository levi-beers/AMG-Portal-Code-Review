@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
<li class="breadcrumb-item">
  @lang('Tools')
</li>
<li class="breadcrumb-item">
  Content Tool
</li>
<li class="breadcrumb-item active">
  Search Results
</li>
@stop

@section('content')

@include('partials.messages')

<div class="row">
  <div class="col-md-4 mt-md-0 mt-2">
    <div class="input-group">
      <button class="btn btn-secondary" id="returnbutton"><i class="fas fa-arrow-alt-circle-left"></i> @lang('Back')</button>
    </div>
    <br>
  </div>
  <div class="col-12 text-justify">
    <h2>{!! $title !!}</h2>
    <br>
  </div>
  <div class="col-12 text-wrap">
    {!! $content !!}
    <br>
  </div>
</div>

@stop

@section('scripts')
<script>
  $(document).ready(function() {
    $("#returnbutton").click(function(e) {
      e.preventDefault();
      history.back();
    });
  });
</script>
@stop