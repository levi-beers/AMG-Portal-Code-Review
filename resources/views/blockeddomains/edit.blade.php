@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
	    <a href="{{ route('blockeddomains.index') }}">Blocked Domains</a>
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
                <a href="{{ route('blockeddomains.index') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
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
  
    <form action="{{ route('blockeddomains.update',$blockeddomain->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row mt-4 mb-4">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Site Name:</strong>
                    <select id="content_site_id" name="content_site_id" class="form-control">
                            <option value="">-- Select a Content Site --</option>
                            @foreach ($contentsites as $contentSite)
                            @if($contentSite->id == $content_site_id)
                                <option value="{{$contentSite->id}}" selected>
                                    Site:({{$contentSite->site_name}}) Domain:({{$contentSite->domain}})
                                </option>
                            @else
                            <option value="{{$contentSite->id}}">
                                Site:({{$contentSite->site_name}}) Domain:({{$contentSite->domain}})
                            </option>
                            @endif
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Delivery Domain:</strong>
                    <select id="delivery_id" name="delivery_id" class="form-control">
                                <option value="">-- Select a Content Site --</option>
                                @foreach ($contentsitedeliverysettings as $contentSiteDeliverySetting)
                                @if($contentSiteDeliverySetting->id == $delivery_id)
                                <option value="{{$contentSiteDeliverySetting->id}}" selected>
                                    Domain:({{$contentSiteDeliverySetting->delivery_domain}}) ID:({{$contentSiteDeliverySetting->id}})
                                </option>
                                @else
                                <option value="{{$contentSiteDeliverySetting->id}}">
                                    Domain:({{$contentSiteDeliverySetting->delivery_domain}}) ID:({{$contentSiteDeliverySetting->id}})
                                </option>
                                @endif
                                @endforeach
                        </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Blocked Domain:</strong>
                    <input type="text" name="domain" class="form-control" value="{{ $blockeddomain->domain }}" placeholder="Domain">
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

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
  
            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#content_site_id').on('change', function () {
                var content_site_id = this.value;
                console.log('SELECTED:'+content_site_id);
                $("#delivery_domain").html('');
                $.ajax({
                    url: "{{url('/api/fetch-delivery-domains')}}",
                    type: "POST",
                    data: {
                        content_site_id: content_site_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#delivery_id').html('<option value="">-- Select Available Delivery Domain --</option>');
                        console.log('RESULT:'+JSON.stringify(result.delivery_domains));
                        $.each(result.delivery_domains, function (key, value) {
                            console.log('KEY:'+key);
                            console.log('VALUE:'+JSON.stringify(value));
                            $("#delivery_id").append('<option value="' + value
                                .id + '">' + value.delivery_domain + '</option>');
                        });
                    }
                });
            });
  
        });
    </script>
@endsection