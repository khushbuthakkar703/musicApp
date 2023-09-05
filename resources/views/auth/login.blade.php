<!DOCTYPE html>
<html lang="en">
<head>
    <script src="/js/beaverbird.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:title" content="Spinstatz | SignUp"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://spinstatz.net/"/>
    <meta property="og:image" content="https://spinstatz.net/share.jpg"/>

    <meta property="og:site_name" content="Spinstatz"/>
    <meta property="og:description" content="All Djs Around The World Get Invitation"/>

    <title>SpinStatz | Login</title>
    
    <script type="text/javascript" src="/js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/typicons.min.css">
    <link rel="stylesheet" href="/css/varello-theme.min.css">
    <link rel="stylesheet" href="/css/varello-skins.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/icheck-all-skins.css">
    <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
    <link href='https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300' rel='stylesheet'
          type='text/css'>
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
    <link rel="manifest" href="../manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	 <style type="text/css">
     
.carousel-fade .carousel-inner .item {
    opacity: 0;
    transition-property: opacity;
}
.carousel-fade .carousel-inner .active {
    opacity: 1;
}
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
    left: 0;
    opacity: 0;
    z-index: 1;
}
.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
    opacity: 1;
}
.carousel-fade .carousel-control {
    z-index: 2;
}
@media all and (transform-3d),
(-webkit-transform-3d) {
    .carousel-fade .carousel-inner > .item.next,
    .carousel-fade .carousel-inner > .item.active.right {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.prev,
    .carousel-fade .carousel-inner > .item.active.left {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.next.left,
    .carousel-fade .carousel-inner > .item.prev.right,
    .carousel-fade .carousel-inner > .item.active {
        opacity: 1;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
}
.item:nth-child(1) {
    background: url(/background/login.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.carousel {
    z-index: -99;
}
.carousel .item {
    position: fixed;
    width: 100%;
    height: 100%;
}


</style>

<div class="carousel slide carousel-fade" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
        </div>
    </div>
</div>
<div class="notifications top-right"></div>
<div class="wrapper" >
         @if($flash=session('message'))
            <div id="modalOpen" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Success</h4>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-success">{{$flash}}</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            <script type="text/javascript">
                jQuery(function($){
                    $(document).ready(function(){
                        $('#modalOpen').modal('show');
                    });
                });
            </script>
        @endif
        @if($flash=session('error'))
            <div id="modalOpen" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Error</h4>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-danger">{{$flash}}</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            <script type="text/javascript">
                jQuery(function($){
                    $(document).ready(function(){
                        $('#modalOpen').modal('show');
                    });
                });
            </script>
        @endif

    <style type="text/css">
        #modalOpen .modal-content {    background: #fff; }
        div#modalOpen {    color: #000; }
        div#modalOpen .modal-header {    background: #eee;    border-radius: 5px 5px 0px 0px; }
        div#modalOpen .modal-footer {    border-top: 1px solid #eee; }
        div#modalOpen .modal-dialog {  margin-top: 0;  margin-bottom: 0;  height: 100vh;  display: flex;  flex-direction: column;  justify-content: center; }
        div#modalOpen .alert{ margin-bottom: 0; }
        div#modalOpen .alert.alert-success {    background: transparent;    color: #000;    border: 0;    border-left: 5px solid #03592b;    background: #f1f1f1; }
        div#modalOpen .alert.alert-danger {    background: transparent;    color: #000;    border: 0;    border-left: 5px solid #aa1f0b;    background: #f1f1f1; }
    </style>

    <div class="page-wrapper">
        <div id="login-hidden">
            <div class="log-in-wrapper">
				<div class="paydiv">
                <h1 class="log-in-title"><img src="/images/SpinstatsApplogo.png" alt="spinstatz_logo" style="max-width: 250px;"/><br></h1>
                   <br><br><br> </div>
					<div class="paydiv">
						<p style="font-size: 25px">Log in</p>
					<small>Please enter your email and password</small>
					</div>


              <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="fingerprint" id="fingerprinthash" value="">
                        <script>
                            document.getElementById('fingerprinthash').value = BeaverBird.uid();
                        </script>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" >
                        <input id="email" type="email" class="form-control input-lg" name="email"
                               value="{{ old('email') }}" required autofocus
                               placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control input-lg"
                               name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                        @endif
                    </div>


                <div class="form-group">
                        <input type="checkbox"
                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember_me" class="icheck-label">
                            Keep me signed in
                        </label>
                    </div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="43%" align="left"> <ul class="login-bottom-links">
                        <li><a href="/password/reset" style="color: rgba(255,255,255,1); font-size: 11px; text-align: left;">Forgot your password?</a></li>
                       <!--  <li><a href='/dj/register'>Need a DJ account?</a></li>
                        <li><a href='/djmanager/create'>Need a Company account?</a></li> -->
                    </ul></td>
      
      <td width="auto"><button type="submit" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">
                        Log In
                </button></td>
    </tr>
    <tr>

<!--        <td width="auto"><a href="/login/google"><button type="button" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">-->
<!--                Log In Google-->
<!--            </button></a>-->
    </tr>
  </tbody>
</table>
	

					

                </form>
            </div>
        </div>
    </div>
	<div background_color="#000"></div>
						   "</div>
</body>
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
     js.src = "https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-customerchat"
  page_id="582913385432510"
>
</div>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117120051-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117120051-1');
</script>

