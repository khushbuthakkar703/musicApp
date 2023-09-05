<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VarelloAdmin</title>
    @include('layout.admin.stylesheets')
    @include('layout.admin.favicon')
    @yield('styles')
    @include('layout.admin.meta')
</head>
<body {!! Session::has('skin.colour') ? 'class="skin-' . Session::get('skin.colour') . '"' : '' !!}>
    @if(config('theme.demoMode'))
    @include('layout.demo.fixedSkinner')
    @endif
    <div class="notifications top-right"></div>
    <div class="wrapper">
        <div class="page-wrapper">
            @include('admin.partials.sidebar')
            @include('admin.partials.navbar')
            <div class="content-wrapper">
                <div class="content-dimmer"></div>
                @yield('content')  
            </div>
        </div>
    </div>
@include('layout.admin.scripts')
@yield('scripts')
</body>
</html>