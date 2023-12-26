@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('styles')
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Mail Network')
    </li>
    <li class="breadcrumb-item active">
        @lang('Delivery Settings for Data Connections')
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="pull-left mb-4">
        <h2>Delivery Settings for Data Connections</h2>
    </div>
    <div class="row my-3 flex-md-row flex-column-reverse">
        <div class="col-md-9">
            @permission('contentsite.create')
                <a href="{{ route('contentsitedeliverysettings.create') }}"><button class="btn btn-lg rounded-0 shadow-sm"
                        style="background-color:#dbdbdb;">
                        <i class="fas fa-plus-square"></i> @lang('Add New Delivery Setting')
                    </button></a>
            @endpermission
        </div>
    </div>

    <table class="table table-bordered" id="datatablerow">
        <thead>
            <tr>
                <th>Content Domain</th>
                <th>Delivery To</th>
                <th>DataSource</th>
                <th>ESP</th>
                <th>Throttle / Time</th>
                <th>Hist. Throttle / Time</th>
                <th width="200px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contentsitedeliverysettings as $contentSiteDeliverySetting)
                @if ($contentSiteDeliverySetting->is_enabled == '1')
                    <tr style="background-color:#83dc60;">
                    @else
                    <tr style="background-color:#ffffff;">
                @endif
                <td>{{ $contentSiteDeliverySetting->contentSite->domain }}</td>
                <td>{{ $contentSiteDeliverySetting->delivery_domain }}</td>
                <td>{{ $contentSiteDeliverySetting->dataSource->datasource_description }}</td>
                <td>{{ $contentSiteDeliverySetting->ESPInfo->esp_name }}<br />{{ $contentSiteDeliverySetting->ESPInfo->esp_description }}
                </td>
                <td>{{ $contentSiteDeliverySetting->throttle }} / {{ $contentSiteDeliverySetting->time_value }}</td>
                <td>{{ $contentSiteDeliverySetting->historic_throttle }} /
                    {{ $contentSiteDeliverySetting->historic_time_value }}</td>
                <td>
                    <form action="{{ route('contentsitedeliverysettings.destroy', $contentSiteDeliverySetting->id) }}"
                        method="POST">
                        @permission('contentsite.manage')
                            <a href="{{ route('contentsitedeliverysettings.edit', $contentSiteDeliverySetting->id) }}"
                                class="btn btn-lg rounded-0 shadow-sm btn-primary text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endpermission
                        @permission('contentsite.delete')
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete the Content Site Delivery Setting for {{ $contentSiteDeliverySetting->contentSite->domain }} on {{ $contentSiteDeliverySetting->delivery_domain }} to {{ $contentSiteDeliverySetting->dataSource->datasource_description }} using {{ $contentSiteDeliverySetting->ESPInfo->esp_description }} ?')"
                                class="btn btn-lg rounded-0 shadow-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endpermission
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script>
        new DataTable('#datatablerow');
    </script>

@stop
