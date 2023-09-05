@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-warning page-header-heading-icon"></span> Alerts </h1>
                <p class="page-header-description">This component allows you to provide contextual feedback messages for user actions with the handful of available and flexible alert boxes.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <!-- START CONTAINER -->
    <div class="row">
        <!-- START CONTENT ROW -->
        <div class="col-xs-12">
            <div class="widget widget-default">
                <header class="widget-header">
                    Basic Examples
                </header>
                <div class="widget-body">
                    <div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully read this important alert message. </div> <div class="alert alert-info" role="alert"> <strong>Heads up!</strong> This alert needs your attention, but it's not super important. </div> <div class="alert alert-warning" role="alert"> <strong>Warning!</strong> Better check yourself, you're not looking too good. </div> <div class="alert alert-danger" role="alert"> <strong>Oh snap!</strong> Change a few things up and try submitting again. </div>
                    <p>Varello provides you with extra variants alongside the original alerts. These provide some more contextual alternatives.</p>
                    <div class="alert alert-primary" role="alert"> <strong>Some information.</strong> Regarding your application, something happened. </div>
                    <div class="alert alert-purple" role="alert"> <strong>Some information.</strong> Regarding your application, something happened. </div>
                    <div class="alert alert-pink" role="alert"> <strong>Some information.</strong> Regarding your application, something happened. </div>
                    <div class="alert alert-faded-blue" role="alert"> <strong>Some information.</strong> Regarding your application, something happened. </div>
                </div>
            </div>

            <div class="widget widget-default">
                <header class="widget-header">
                    Notification Alerts
                </header>
                <div class="widget-body">
                    <p>The Bootstrap Notify library (credit to <a href="http://goodybag.github.io/bootstrap-notify">http://goodybag.github.io/bootstrap-notify</a> for this great plugin) allows you to alerts pop-up like notifications. See link for extensive documentation of the features.</p>
                    <button type="button" class="btn btn-xl btn-transparent btn-transparent" id="trigger-demo-notify">Trigger Notifications</button>
                </div>
            </div>

            <div class="widget widget-default">
                <header class="widget-header">
                    Dismissable Alerts
                </header>
                <div class="widget-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Warning!</strong> Better check yourself, you're not looking too good.
                    </div>
                </div>
            </div>

            <div class="widget widget-default">
                <header class="widget-header">
                    Links In Alerts
                </header>
                <div class="widget-body">
                    <div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>. </div> <div class="alert alert-info" role="alert"> <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important. </div> <div class="alert alert-warning" role="alert"> <strong>Warning!</strong> Better check yourself, you're <a href="#" class="alert-link">not looking too good</a>. </div> <div class="alert alert-danger" role="alert"> <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again. </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT ROW -->
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset_segmented('css/bootstrap-notify.css') }}">
@endsection

@section('scripts')
<script src="{{ asset_segmented('js/bootstrap-notify.min.js') }}"></script>
@endsection