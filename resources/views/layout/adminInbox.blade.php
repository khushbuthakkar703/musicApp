@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            @yield('sidebarContent')
        </div>
        <div class="col-xs-12 col-md-9">
            @yield('rightContent')
        </div>
    </div>
</div>
@endsection