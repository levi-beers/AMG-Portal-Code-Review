@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ url('assets/css/custom.css') }}">
@stop

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
  <div class="col">
    <h3 class="p-3">Search Results For "{{$search_term}}"</h3>
  </div>
</div>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
  @foreach ($json_data->value as $mydata)
  <div class="col mb-3">
    <div class="card h-100 ">
      <div class="embed-responsive embed-responsive-16by9">
        @if(isset($mydata->image->thumbnail->contentUrl))
        <a href="{{ route('content-tool.scrape', ['url' => $mydata->url]) }}"><img src="{{$mydata->image->thumbnail->contentUrl}}&h=250" class="card-img-top embed-responsive-item zoom-link" alt="..."></a>
        @else
        <a href="{{ route('content-tool.scrape', ['url' => $mydata->url]) }}"><img src="{{ url('assets/img/placeholder.jpg') }}" height="250" class="card-img-top embed-responsive-item zoom-link" alt="..."></a>
        @endif
      </div>
      <div class="card-body">
        <h5 class="card-title font-weight-bold">{{$mydata->name}}</h5>
        <p class="card-text">{{$mydata->description}}</p>
      </div>
      <div class="card-footer">
        <small class="text-muted"><span class="text-light badge rounded-pill bg-secondary p-1">Published:</span> {{date('m/d/Y h:i:s A', strtotime($mydata->datePublished))}}</small>
      </div>
      @if(isset($mydata->provider[0]->name))
      <div class="card-footer">
        <small class="text-muted"><span class="text-light badge rounded-pill bg-secondary p-1">Source:</span> {{$mydata->provider[0]->name}}</small>
      </div>
      @endif
    </div>
  </div>
  @endforeach
</div>
@stop