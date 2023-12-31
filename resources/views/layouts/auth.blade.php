<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    {!! HTML::style('assets/css/app.css') !!}
    {!! HTML::style('assets/css/fontawesome-all.min.css') !!}

    @yield('header-scripts')

    @hook('auth:styles')
</head>
<body class="auth" style="size:1040px;height:960px;background:url('assets/img/back.jpg') no-repeat; background-size: cover;">
    <div id="all" style="background-color:#ffffffb0; padding-bottom: 20px;">
        <div class="container">
            @yield('content')
        </div>

        {!! HTML::script('assets/js/vendor.js') !!}
        {!! HTML::script('assets/js/as/app.js') !!}
        {!! HTML::script('assets/js/as/btn.js') !!}
        @yield('scripts')
        @hook('auth:scripts')
    </div>
</body>
</html>
