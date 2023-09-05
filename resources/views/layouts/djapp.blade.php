@php
  $currentUser = auth()->user();
  $djdata = App\Dj::where('user_id',$currentUser->id)->first();
  $diamondCount = $djdata->total_spin/1000+1;
  $role = auth()->user()->role;
  $role=ucwords($role);
@endphp

<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <title>Spinstatz | DJ Dashboard</title>

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="/images/android-desktop.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Material Design Lite">
  <link rel="apple-touch-icon-precomposed" href="/images/ios-desktop.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="/images/touch/ms-touch-icon-144x144-precomposed.png">
  <meta name="msapplication-TileColor" content="#3372DF">

  <link rel="stylesheet" type="text/css" href="/css/custom.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/js/easyqrcodejs/src/easy.qrcode.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Core UI icons -->
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">

  <!-- Favicon -->
  <link rel="shortcut icon" href="/images/favicon.png">

  <!-- Add Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- Add Material Design Lite CSS -->
  <link rel="stylesheet" href="/css/material.css?v=1.5">
  <!-- Add custom Spinstatz CSS -->
  <link rel="stylesheet" href="/css/spinstatz.css?v=1.5">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/typicons.min.css">
  <link rel="stylesheet" href="/css/nutip.css">
  <link rel="stylesheet" href="/css/varello-theme.min.css">
  <link rel="stylesheet" href="/css/varello-skins.min.css">
  <link rel="stylesheet" href="/css/animate.min.css">
  <link rel="stylesheet" href="/css/icheck-all-skins.css">
  <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
  <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300" rel="stylesheet" type="text/css">
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
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


  <style>

  </style>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header" style="position: relative; overflow-y:hidden">

  <!-- header -->
@include('components.djdashboardheader')
<!-- endheader -->

  <!-- sidebar -->
@include('components.djdashboardsidebar')
<!-- endsidebar -->

  <!-- @if($flash=session('message'))
    <div class="alert alert-success" role="alert">
      {{$flash}}
    </div>
  @endif
  @if($flash=session('error'))
    <div class="alert alert-danger" role="alert">
      {{$flash}}
    </div>
  @endif
 -->
  @yield('content')
</div>
</body>


<script src="/js/Chart.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.piety.min.js"></script>
<script src="/js/varello-theme.js"></script>
<script src="/js/icheck.min.js"></script>
<script src="/js/dropdown.js"></script>

<!-- <script src="https://unpkg.com/turbolinks"></script> -->
<script src="/js/material.js"></script>
<!-- Add jQuery -->
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
<!-- Add custom Spinstatz JS -->
<script src="/js/spinstatz.js?v=1.5"></script>
<script type="text/javascript">
  jQuery(function(){
    $(document).on('click','.desktop-toggle-handler',function(){
      $(this).find('.fas').toggleClass('fa-arrow-left fa-arrow-right');
      $('body').toggleClass('isClosed');
    }); 
  })
</script>
