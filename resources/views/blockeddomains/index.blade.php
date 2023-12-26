@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item">
        @lang('Content Sites')
    </li>
    <li class="breadcrumb-item active">
	Blocked Domains
    </li>
@stop

@section('content')

@include('partials.messages')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
                <h2>Alchemy Media Group's Blocked Domains</h2>
            </div>
            @permission('contentsite.create')
            <div class="pull-right mb-5">
                <a href="{{ route('blockeddomains.create') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                    <i class="fas fa-plus-square"></i> @lang("Add New Blocked Domain")
                </button></a>
            </div>
            @endpermission
        </div>
    </div>



    <table class="table table-bordered">
        <tr>
            <th>Site Name</th>
            <th>Content Domain</th>
            <th>Delivery To</th>
            <th>Blocked Domain</th>
        </tr>
        @foreach ($blockeddomains as $blockedDomain)
        <tr>
            <td>{{ $blockedDomain->contentSite->site_name }}</td>
            <td>{{ $blockedDomain->contentSite->domain }}</td>
            <td>{{ $blockedDomain->contentSiteDeliverySetting->delivery_domain }}</td>
            <td>{{ $blockedDomain->domain }}</td>
            <td width="200px">
                <form action="{{ route('blockeddomains.destroy',$blockedDomain->id) }}" method="POST">
                    @permission('contentsite.manage')
                    <a href="{{ route('blockeddomains.edit',$blockedDomain->id) }}" class="btn btn-lg rounded-0 shadow-sm btn-primary text-white">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endpermission
                    @permission('contentsite.delete')
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete the blocked domain {{ $blockedDomain->domain }} through {{ $blockedDomain->contentSite->domain }} to {{ $blockedDomain->contentSiteDeliverySetting->delivery_domain }}?')" class="btn btn-lg rounded-0 shadow-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endpermission
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $blockeddomains->links() !!}

@endsection
