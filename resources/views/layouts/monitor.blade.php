<html>
  <head>
    <meta charset="utf-8">
    <title>SpinStatz</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/typicons.min.css">
    <link rel="stylesheet" href="/css/varello-theme.min.css">
    <link rel="stylesheet" href="/css/varello-skins.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/icheck-all-skins.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
    <script src="/js/jquery-1.12.3.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    <!-- Validetta CSS -->
    <link href="css/validetta.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300" rel="stylesheet" type="text/css">    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
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
    {!! Html::style('css/jquery.dataTables.min.css') !!}
    {!! Html::style('css/buttons.bootstrap.min.css') !!}
    {!! Html::style('css/custom-table.css') !!}
  </head>
  <body>
    <div class="notifications top-right"></div>
    <div class="page-wrapper">
      <aside class="left-sidebar" style="min-height: 280px;">
        <section class="sidebar-user-panel">
          <div id="user-panel-slide-toggleable">
            <div class="user-panel-profile-picture"> <img src="/img/user-1-profile.jpg" alt="Tyrone G"> </div>
            <span class="user-panel-logged-in-text"><span class="fa fa-circle-o text-success user-panel-status-icon"></span> Logged in as <strong> monitors</strong></span>
            <span style="text-align: center">
            </div>
          </section>
          <ul class="sidebar-nav">
            <li class="sidebar-nav-heading"> Dashboard </li>
            <li class="sidebar-nav-link">
              <a href="/admin/campaign/payments">
                <span class="typcn typcn-home sidebar-nav-link-logo"></span> Campaign Payments
              </a>
            </li>
            </ul>
          </aside>
          <header class="top-header"> <a href="/" class="top-header-logo"> <span class="text-primary"><img src="/img/mini logo.png" width="112" height="45" alt=""></span></a>
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar=""> <span class="typcn typcn-arrow-left visible-sidebar-sm-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span> <span class="typcn typcn-arrow-left visible-sidebar-md-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-md-closed"></span> </button>
              </div>
              <ul class="nav navbar-nav navbar-right" data-dropdown-in="flipInX" data-dropdown-out="zoomOut">
              <li><a href="/logout"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="content-wrapper" style="min-height: 600px;">
        
        <div class="content-dimmer"></div>
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
    <div class="wrapper"><small></small>
    </div>
    <script src="/js/Chart.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.piety.min.js"></script>
    <script src="/js/varello-theme.js"></script>
    <script src="/js/icheck.min.js"></script>
    <script src="/js/dropdown.js"></script>
    <script src="/js/datatables.min.js"></script>
    <script src="{{asset('js/validetta.js')}}"></script>
    <script >$("#form").validetta();</script>
    @yield('custom_js')
  </body>
</html>