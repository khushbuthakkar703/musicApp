<meta charset="utf-8">
<title>SpinStatz | Register</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/typicons.min.css">
<link rel="stylesheet" href="../css/varello-theme.min.css">
<link rel="stylesheet" href="../css/varello-skins.min.css">
<link rel="stylesheet" href="../css/animate.min.css">
<link rel="stylesheet" href="../css/icheck-all-skins.css">
<link rel="stylesheet" href="../css/icheck-skins/flat/_all.css">
<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300" rel="stylesheet" type="text/css">
<link rel="apple-touch-icon" sizes="57x57" href="../apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="../android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
<link rel="manifest" href="../manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body data-gr-c-s-loaded="true">
<div class="notifications top-right"></div>
<div class="wrapper">
    <div class="page-wrapper">
        @yield('content')
    </div>

    <footer class="content-wrapper-footer">
        © Copyright 2017 SpinStatz <a href="#" target="_blank">OttoMation Solutions LLC&nbsp;&nbsp;  </a>
    </footer>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '1476167555843900',
                autoLogAppEvents: true,
                xfbml: true,
                version: 'v2.12'
            });
        };
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="fb-customerchat" page_id="582913385432510">
    </div>

</div>
</body>