@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading', $user->present()->nameOrEmail)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        @lang('Tools')
    </li>
    <li class="breadcrumb-item active">
	Content Vertical Settings
    </li>
@stop

@section('content')

@include('partials.messages')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
                <h2>Alchemy Media Group's Content Verticals</h2>
            </div>
            @permission('contentverticals.manage')
            <div class="pull-right mb-5">
                <a href="{{ route('contentverticals.create') }}"><button class="btn btn-lg rounded-0 shadow-sm" style="background-color:#dbdbdb;">
                    <i class="fas fa-plus-square"></i> @lang("Add New Content Vertical")
                </button></a>
            </div>
            @endpermission
        </div>
    </div>



    <table class="table table-bordered">
        <tr>
            <th>Vertical ID</th>
            <th>Vertical Name</th>
            <th>Vertical Desc</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($contentverticals as $contentVertical)
        <tr>
            <td>{{ $contentVertical->id }}</td>
            <td>{{ $contentVertical->vertical_name }}</td>
            <td>{{ $contentVertical->vertical_description }}</td>
            <td>
                <form action="{{ route('contentverticals.destroy',$contentVertical->id) }}" method="POST">
                    @permission('contentverticals.manage')
                    <a href="{{ route('contentverticals.edit',$contentVertical->id) }}" class="btn btn-lg rounded-0 shadow-sm btn-primary text-white">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endpermission
                    @permission('contentverticals.delete')
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Content Vertical {{ $contentVertical->vertical_name }}?')" class="btn btn-lg rounded-0 shadow-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endpermission
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $contentverticals->links() !!}

@endsection
