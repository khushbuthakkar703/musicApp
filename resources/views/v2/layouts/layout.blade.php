@php
    $currentUser = auth()->user();
    $role = auth()->user()->role;
    $role=ucwords($role);
    $me = \App\Advertiser::where('user_id', $currentUser->id)->first();
@endphp

<html>
<head>
   @include('v2.includes.head')
</head>
<body>

<div class="notifications top-right"></div>
<div class="page-wrapper">
    <aside class="left-sidebar">
        <section class="sidebar-user-panel">
            <div id="user-panel-slide-toggleable">
                @if($currentUser->profile_picture==='/img/campaign.png'|| $currentUser->profile_picture==null)
                    <form method="POST" id="image-form" action="/dj/profileUpload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="file"  style="visibility:hidden" name="file" id="imgUpload">
                            <input type="button" value="Upload Image" class="btn btn-transparent btn-transparent-primary btn-block upload-form" onclick="$('#imgUpload').click();" />
                            @if ($errors->has('file'))
                                <span class="text-danger">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                            @endif
                        </div>

                    </form>
                @else
                    <form method="POST" id="image-form" action="/dj/profileUpload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file"  style="visibility:hidden" name="file" id="imgUpload">
                        @if ($errors->has('file'))
                            <span class="text-danger">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                        @endif
                    </form>
                    <div class="user-panel-profile-picture">
                        <div class="container">
                            <img src="{{ url($currentUser->profile_picture) }}" alt="{{$currentUser->username}}" onclick="$('#imgUpload').click();">
                            <div class="overlay" onclick="$('#imgUpload').click();">
                                <div class="text" style="font-size: small">Change profile picture</div>
                            </div>
                        </div>
                @endif


                        <div class="progress hidden" id="progressBar" style="height: fit-content">
                            <div class='progress progress-striped active'>
                                <div class='progress-bar progress-bar-color' id='bar' role='progressbar' style='width: 100%'>Uploading</div>
                            </div>
                        </div>
                    </div>

                        <span class="user-panel-logged-in-text"><span
                            class="fa fa-circle-o text-success user-panel-status-icon"></span> Logged in as <strong> {{$currentUser->username}}</strong></span>
                <a href="/advertiser/profile/edit" class="user-panel-action-link"><span class="fa fa-pencil"></span>Manage your
                    account</a>
            </div>
            <!-- <button class="user-panel-toggler" data-slide-toggle="user-panel-slide-toggleable"><span class="fa fa-chevron-up" data-slide-toggle-showing></span><span class="fa fa-chevron-down" data-slide-toggle-hidden></span></button> -->
        </section>

        @include('v2.layouts.navbar.'.$role)
    </aside>
    <header class="top-header">
        <a href="/" class="top-header-logo" style="position: fixed">
            <span class="text-primary">
                <img  src="/img/mini logo.png" width="112" height="45" alt="SpinStatz">
            </span>
        </a>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar=""><span
                                class="typcn typcn-arrow-left visible-sidebar-sm-open"></span> <span
                                class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span> <span
                                class="typcn typcn-arrow-left visible-sidebar-md-open"></span> <span
                                class="typcn typcn-arrow-right visible-sidebar-md-closed"></span></button>
                </div>

                <ul class="nav navbar-nav navbar-right " data-dropdown-in="flipInX" data-dropdown-out="zoomOut">
                    <li class="hidden-sm hidden-xs hidden-md"><a href="#">Welcome to Spinstatz, <strong><?php echo auth()->user()->username." "; ?></strong><?php echo "(".$role.")"; ?></a></li>

                    <li class="item-feed dropdown">
                            <a href="#" class="item-feed-toggle getAllNotifications" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-bell"></span>
                                <span class="badge badge-danger item-feed-badge unseen-noification-count"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-notifications" style="overflow-y: scroll; height:400px;">

                            </ul>

                        </li>
                    <li><a href="/logout"><span class="fa fa-sign-out"></span> <span
                                    class="hidden-sm hidden-xs">Log out</span></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="content-wrapper" style="min-height: 133px;">
        <div style="padding-top: 70px">
        <div class="content-dimmer">

        </div>
        @if($flash=session('message'))
            <div class="alert alert-success" role="alert">
                {{$flash}}
            </div>
        @endif
        @if($flash=session('error'))
            <div class="alert alert-danger" role="alert">
                {{$flash}}
            </div>
        @endif

            @yield('content')
            <script src="/js/notification.js"></script>
        </div>

    </div>
</div>

<div class="wrapper">
    <script src="/js/Chart.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script src="/js/varello-theme.js"></script>
    <script src="/js/icheck.min.js"></script>
    <script src="/js/dropdown.js"></script>

</div>
<script>
    $('#imgUpload').change(function() {
        $('#image-form').submit();
        displayAnimation();
    });
</script>

<script>
    function displayAnimation()
    {
        $("#progressBar").removeClass('hidden');
    }
</script>
@yield('custom_js')
</body>
<footer class="content-wrapper-footer"> &copy; Copyright 2017 SpinStatz <a href="#" target="_blank">OttoMation
        Solutions LLC</a>.
</footer>
</html>
