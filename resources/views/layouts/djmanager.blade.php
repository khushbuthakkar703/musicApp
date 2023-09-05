@php
    $currentUser = auth()->user();
    // add role 27-7-18
    $role = auth()->user()->role;
    $role=ucwords($role);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/font-awesome.min.css') !!}
    {!! Html::style('css/typicons.min.css') !!}
    {!! Html::style('css/varello-theme.min.css') !!}
    {!! Html::style('css/varello-skins.min.css') !!}
    {!! Html::style('css/animate.min.css') !!}
    {!! Html::style('css/icheck-all-skins.css') !!}
    {!! Html::style('css/jquery.dataTables.min.css') !!}
    {!! Html::style('css/buttons.bootstrap.min.css') !!}
    <link href='https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300' rel='stylesheet' type='text/css'>    <link rel="apple-touch-icon" sizes="57x57" href="../apple-icon-57x57.png">
    <script src="/js/jquery-1.12.3.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    {!! Html::style('css/custom-table.css') !!}
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
<!-- Validetta CSS -->
<link rel="shortcut icon" sizes="60x60" href="{{ asset('apple-icon-60x60.png') }}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="../apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('android-icon-192x1902.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"></head>

<body >

    <div class="notifications top-right"></div>
    <div class="wrapper">
        <div class="page-wrapper">
            <aside class="left-sidebar">
                <section class="sidebar-user-panel">
                    <div id="user-panel-slide-toggleable">

                        @if($currentUser->profile_picture==='/img/campaign.png'|| $currentUser->profile_picture==null)
                        <form method="POST" id="image-form" action="/djmanager/profileUpload" enctype="multipart/form-data">
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
                            {{--<input type="submit" value="Upload image" class="btn btn-transparent btn-lg btn-transparent-primary btn-block upload-form" onclick="displayAnimation()">--}}
                            {{--<div class="col-12 mb-2">--}}

                                {{--<label for="file" class="control-label">Upload image</label>--}}

                                {{--<input class="form-control-file" name="file" type="file" id="file">--}}

                            {{--</div>--}}

                        </form>

                        {{--<div class="progress">--}}

                            {{--<div id="progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}

                        {{--</div>--}}


                        @else
                        <form method="POST" id="image-form" action="/djmanager/profileUpload" enctype="multipart/form-data">
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
                            </div> @endif


                            <div class="progress hidden" id="progressBar" style="height: fit-content">
                                <div class='progress progress-striped active'>
                                    <div class='progress-bar progress-bar-color' id='bar' role='progressbar' style='width: 100%'>Uploading</div>
                                </div>
                            </div>
                        </div>

                            <span class="user-panel-logged-in-text"><span class="fa fa-circle-o text-success user-panel-status-icon"></span> Logged in as <strong> {{$currentUser->username}}</strong></span>

                            <a href="/djmanager/update" class="user-panel-action-link"><span class="fa fa-pencil"></span> Manage your account</a>

                        </div>

                    </section>

                    <ul class="sidebar-nav">

                        <li class="sidebar-nav-heading">

                            Components

                        </li>

                        <li class="sidebar-nav-link dashboard">

                            <a href="/djmanager">

                                <span class="typcn typcn-home sidebar-nav-link-logo"></span>  Dashboard

                            </a>

                        </li>




                        <li class="sidebar-nav-link sidebar-nav-link-group messaging">
                            <a data-subnav-toggle>
                                <span class="typcn typcn-messages sidebar-nav-link-logo"></span> Messaging
                            </a>
                            <ul class="sidebar-nav">
                                <li class="sidebar-nav-link"></li>
                                <li class="sidebar-nav-link inbox">
                                    <a href="/djmanagers/messages/inbox">
                                        <span class="typcn typcn-folder-open sidebar-nav-link-logo"></span> Inbox <span class="badge badge-info sidebar-nav-link-badge"></span>
                                    </a>
                                </li>
                                <li class="sidebar-nav-link "> <a href="/djmanager-notification"> <span class="fa fa-bell sidebar-nav-link-logo"></span> Notifications </a> </li>
                                <li class="sidebar-nav-link message">
                                    <a href="/djmanagers/messages/compose">
                                        <span class="typcn typcn-arrow-forward sidebar-nav-link-logo"></span> Message DJs
                                    </a>

                                </li>
                                <li class="sidebar-nav-link invite">

                                    <a href="/djmanager/invite">

                                        <span class="typcn typcn-mail sidebar-nav-link-logo"></span> Invite New DJs</a>

                                    </li>



                                </ul>

                            </li>

                            <li class="sidebar-nav-link pending">

                                <a href="/invitedEmail">

                                    <span class="typcn typcn-group-outline sidebar-nav-link-logo"></span>  Pending Invitations

                                </a>

                            </li>
                            <li class="sidebar-nav-link pending">

                                <a href="/djmanagers/active_campaigns">

                                    <span class="typcn typcn-group-outline sidebar-nav-link-logo"></span>  Active Campaigns

                                </a>

                            </li>

                            <li class="sidebar-nav-link pending">

                                <a href="/djmanager/manage/actions">

                                    <span class="typcn typcn-group-outline sidebar-nav-link-logo"></span>  Manage Events

                                </a>

                            </li>

                            <li class="sidebar-nav-link campaigns">

                                <a href="/djmanager/campaigns">

                                    <span class="typcn typcn-group-outline sidebar-nav-link-logo"></span>  Campaigns

                                </a>

                            </li>

                        <li class="sidebar-nav-link pending">

                            <a href="/huddle">

                                <span class="typcn typcn-group-outline sidebar-nav-link-logo"></span>  Huddle

                            </a>

                        </li>
                        <li class="sidebar-nav-link pending">

                            <a href="/keyer">

                                <span class="typcn typcn-group-outline sidebar-nav-link-logo"></span>  Start Keying

                            </a>

                        </li>

                            <!-- <div class="alert alert-success" role="alert"> <strong>View Campaigns</strong> <a href="/djmanagers/active_campaigns"><strong>63</strong> Active</a></div> -->




                        </ul>

                    </aside>
                    <header class="top-header">
                        <a href="/" class="top-header-logo">
                            <img src="https://spinstatz.com/wp-content/uploads/2020/03/mini-logo.png" style="max-width: 112px;" alt="SpinStatz Logo"/></a>
                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar>
                                            <span class="typcn typcn-arrow-left visible-sidebar-sm-open"></span>
                                            <span class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span>
                                            <span class="typcn typcn-arrow-left visible-sidebar-md-open"></span>

                                            <span class="typcn typcn-arrow-right visible-sidebar-md-closed"></span>

                                        </button>

                                    </div>


                                    <ul class="nav navbar-nav navbar-right" data-dropdown-in="flipInX" data-dropdown-out="zoomOut">

                                       <li class="hidden-sm hidden-xs hidden-md"><a href="#">Welcome to Spinstatz, <strong><?php echo auth()->user()->username." "; ?></strong><?php echo "(".$role.")"; ?></a></li>
                                        <li class="item-feed dropdown">
                                            <a href="#" class="item-feed-toggle getAllNotifications" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-bell"></span>
                                                <span class="badge badge-danger item-feed-badge unseen-noification-count"></span>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-notifications">

                                            </ul>

                                        </li>

                                        <li><a href="/logout"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>

                                    </ul>

                                </div>

                            </nav>

                        </header>
                        <div class="content-wrapper">
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
    <script type="text/javascript">
      jQuery(function(){
        $(document).on('click','.desktop-toggle-handler',function(){
          $(this).find('.fas').toggleClass('fa-arrow-left fa-arrow-right');
          $('body').toggleClass('isClosed');
        }); 
      })
    </script>
<style>
	.dropdown-menu-notifications-item-content span {	display: inline-block;	vertical-align: middle;	padding: 0;}
	.dropdown-menu-notifications-item-content p {	margin: 0;	padding-left: 10px;}
	.dropdown-menu-notifications-item-content span p:first-child{ font-weight: bold; color: #1CA2CE; }
	.dropdown-menu.dropdown-menu-notifications {	padding: 0 !important; }
	.dropdown-menu-notifications a {	padding: 7px 15px !important; }
	.dropdown-menu.dropdown-menu-notifications li {	background: #2f3638; }
	.dropdown-menu.dropdown-menu-notifications li:nth-child(2n) {	background: #424445; }
</style>

    {!! Html::script('js/Chart.min.js') !!}

    {!! Html::script('js/bootstrap.min.js') !!}

    {!! Html::script('js/jquery.piety.min.js') !!}

    {!! Html::script('js/varello-theme.js') !!}

    {!! Html::script('js/icheck.min.js') !!}

    {!! Html::script('js/dropdown.js') !!}
</body>

</html>
@yield('custom_js')
