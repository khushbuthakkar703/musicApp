@php
    $currentUser = auth()->user();
    $role = auth()->user()->role;
    $role=ucwords($role);
    $me = \App\Advertiser::where('user_id', $currentUser->id)->first();     
@endphp

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/typicons.min.css">
    <link rel="stylesheet" href="/css/varello-theme.min.css">
    <link rel="stylesheet" href="/css/varello-skins.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/icheck-all-skins.css">
    <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300" rel="stylesheet"
          type="text/css">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    {!! Html::style('css/jquery.dataTables.min.css') !!}
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .container {
            position: relative;
            width: 100%;
            padding-left: 0px;
            padding-right: 0px;
        }
        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: #008CBA;
        }

        .container:hover .overlay {
            opacity: 1;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>    
<script src="/js/datatables.min.js"></script>
{!! Html::style('css/custom-table.css') !!}
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
        <ul class="sidebar-nav">
            <li class="sidebar-nav-heading components"> Components</li>
            <li class="sidebar-nav-link dashboard">
                <a href="/advertiser"> 
                    <span class="typcn typcn-home sidebar-nav-link-logo "></span> Dashboard 
                </a>
            </li>
            <li class="sidebar-nav-link dashboard">
                <a href="/invitecampaign"> 
                    <span class="typcn typcn-home sidebar-nav-link-logo "></span> Invite Campaign 
                </a>
            </li>
            @if($me->invited_by == null)
            <li class="sidebar-nav-link dashboard">
                <a href="{{route('employees')}}"> 
                    <span class="typcn typcn-home sidebar-nav-link-logo "></span> Employees 
                </a>
            </li>
            <li class="sidebar-nav-link dashboard">
                <a href="/advertiser/details/{{$me->id}}"> 
                    <span class="typcn typcn-home sidebar-nav-link-logo "></span> Details 
                </a>
            </li>
            @else
            <li class="sidebar-nav-link dashboard">
                <a href="/employee/details/{{$me->id}}"> 
                    <span class="typcn typcn-home sidebar-nav-link-logo "></span> Details
                </a>
            </li>
            @endif
        </ul>
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
    <script src="/js/jquery.piety.min.js"></script>
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
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '1476167555843900',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-customerchat"
  page_id="582913385432510"
>
</div>

<style>
  .dropdown-menu-notifications-item-content span {  display: inline-block;  vertical-align: middle; padding: 0;}
  .dropdown-menu-notifications-item-content p { margin: 0;  padding-left: 10px;}
  .dropdown-menu-notifications-item-content span p:first-child{ font-weight: bold; color: #1CA2CE; }
  .dropdown-menu.dropdown-menu-notifications {  padding: 0 !important; }
  .dropdown-menu-notifications a {  padding: 7px 15px !important; }
  .dropdown-menu.dropdown-menu-notifications li { background: #2f3638; }
  .dropdown-menu.dropdown-menu-notifications li:nth-child(2n) { background: #424445; }
</style>
