@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item active">
	Content Site Settings
    </li>
@stop

@section('content')

@include('partials.messages')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
                <h2>Alchemy Media Group's Content Sites</h2>
            </div>
            @permission('contentsite.create')
            <div class="pull-right mb-5">
                <a href="{{ route('contentsites.create') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                    <i class="fas fa-plus-square"></i> @lang("Add New Content Site")
                </button></a>
            </div>
            @endpermission
        </div>
    </div>



    <table class="table table-bordered">
        <tr>
            <th>Site Name</th>
            <th>Domain</th>
            <th>Vertical ID</th>
            <th>App Pass</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($contentsites as $contentSite)
        <tr>
            <td>{{ $contentSite->site_name }}</td>
            <td>{{ $contentSite->domain }}</td>
            <td>{{ $contentSite->vertical_id }} | {{ $contentSite->contentVertical->vertical_name }} </td>
            <td>{{ $contentSite->app_password }}</td>
            <td>
                <form action="{{ route('contentsites.destroy',$contentSite->id) }}" method="POST">
                    @permission('contentsite.manage')
                    <a href="{{ route('contentsites.edit',$contentSite->id) }}" class="btn btn-lg rounded-0 shadow-sm btn-primary text-white">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endpermission
                    @permission('contentsite.delete')
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Content Site {{ $contentSite->site_name }}?')" class="btn btn-lg rounded-0 shadow-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endpermission
                </form>
            </td>
        </tr>
        @endforeach
    </table>


@endsection
