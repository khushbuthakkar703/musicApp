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



<div class="notifications top-right"></div>
<div class="page-wrapper">
    <aside class="left-sidebar">
        
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
                    <li class="hidden-sm hidden-xs hidden-md"><a href="#">Welcome to Spinstatz, <strong></a></li>
                    
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
