<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('profile') }}" class="text-center no-decoration text-primary">
                <div class="icon my-3">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <p class="lead mb-0">@lang('Update Profile')</p>
            </a>
        </div>
    </div>
</div>

@if (config('session.driver') == 'database')
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('profile.sessions') }}" class="text-center  no-decoration text-primary">
                <div class="icon my-3">
                    <i class="fa fa-list fa-2x"></i>
                </div>
                <p class="lead mb-0">@lang('My Sessions')</p>
            </a>
        </div>
    </div>
</div>
@endif

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('profile.activity') }}" class="text-center no-decoration text-primary">
                <div class="icon my-3">
                    <i class="fas fa-server fa-2x"></i>
                </div>
                <p class="lead mb-0">@lang('Activity Log')</p>
            </a>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('auth.logout') }}" class="text-center no-decoration text-primary">
                <div class="icon my-3">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
                </div>
                <p class="lead mb-0">@lang('Logout')</p>
            </a>
        </div>
    </div>
</div>

@permission('view.data.stats')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            @include('plugins.dashboard.widgets.datasource4-history')
        </div>
    </div>
</div>

@section('scripts')
{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/chartjs-plugin-datasource.min.js') !!}
{!! HTML::script('assets/js/as/datasource4.js') !!}
@stop

@endpermission