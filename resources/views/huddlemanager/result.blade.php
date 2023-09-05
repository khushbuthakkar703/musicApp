{{--@extends('layouts.admin')--}}
{{--@section('content')--}}
{{--    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>--}}
{{--    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.1/TweenMax.min.js"></script>--}}
{{--    <script>--}}

{{--        // Enable pusher logging - don't include this in production--}}
{{--        //Pusher.logToConsole = true;--}}

{{--        var pusher = new Pusher('f8c4b57e1222cc6aeb6f', {--}}
{{--            cluster: 'mt1',--}}
{{--            forceTLS: true--}}
{{--        });--}}

{{--        var channel = pusher.subscribe('reacted');--}}
{{--        channel.bind('audio-{{$musicCampaignAudio->id}}', function(data) {--}}
{{--            $("#likes").text(JSON.parse(data.message).likes);--}}
{{--            $("#dislikes").text(JSON.parse(data.message).dislikes);--}}
{{--        });--}}

{{--        var channel2 = pusher.subscribe('campaign-action');--}}
{{--        channel2.bind('{{$musicCampaign->id}}', function (data) {--}}
{{--            debugger;--}}
{{--            $("#accepted-count").text(JSON.parse(data.message).count)--}}
{{--        })--}}
{{--    </script>--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="">--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading">--}}
{{--                        HUDDLE RESULTS PAGE--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <li>{{$musicCampaign->campaign_name}}</li>--}}
{{--                            <li>{{$musicCampaignAudio->company_name}}</li>--}}
{{--                            <li>{{$musicCampaignAudio->artist_name}}</li>--}}
{{--                            <li>{{\App\City::find($musicCampaign->city)->name}}</li>--}}

{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <li>--}}
{{--                                LIKES--}}
{{--                            </li>--}}
{{--                            <li id="likes">--}}
{{--                                {{$musicCampaign->likes}}--}}
{{--                            </li>--}}

{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <h1>{{$musicCampaignAudio->song_title}}</h1>--}}
{{--                            <div style="padding-left: 0px;" class="audio-player-image col-lg-12 col-sm-12 col-xs-12">--}}
{{--                                <img src="/{{$musicCampaignAudio->artwork}}" height="180" width="180" alt="{{$musicCampaignAudio->song_title}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div lass="col-lg-3">--}}
{{--                            <li>--}}
{{--                                DISLIKES--}}
{{--                            </li>--}}
{{--                            <li id="dislikes">--}}
{{--                                {{$musicCampaign->dislikes}}--}}
{{--                            </li>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-12">--}}
{{--                            Accepted By : <span id="accepted-count">{{$acceptedCount}}</span>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



{{--@endsection--}}
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DJ HUDDLE</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/typicons.min.css">
    <link rel="stylesheet" href="/css/varello-theme.min.css">
    <link rel="stylesheet" href="/css/varello-skins.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/icheck-all-skins.css">
    <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
    <link href='https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300' rel='stylesheet' type='text/css'>    <link rel="apple-touch-icon" sizes="57x57" href="../apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="">
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.1/TweenMax.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        //Pusher.logToConsole = true;

        var pusher = new Pusher('f8c4b57e1222cc6aeb6f', {
            cluster: 'mt1',
            forceTLS: true
        });

        var channel = pusher.subscribe('reacted');
        channel.bind('audio-{{$musicCampaignAudio->id}}', function(data) {
            $("#likes").text(JSON.parse(data.message).likes);
            $("#dislikes").text(JSON.parse(data.message).dislikes);
        });

        var channel2 = pusher.subscribe('campaign-action');
        channel2.bind('{{$musicCampaign->id}}', function (data) {
            debugger;
            $("#accepted-count").text(JSON.parse(data.message).count)
        })
    </script>
<div class="notifications top-right"></div>
<div class="wrapper">
    <div class="page-wrapper">
        <aside class="left-sidebar">
            <section class="sidebar-user-panel"><img src="/img/Huddle.png" width="100" height="110" alt=""/>
                <div id="user-panel-slide-toggleable"> </div>
                <!-- <button class="user-panel-toggler" data-slide-toggle="user-panel-slide-toggleable"><span class="fa fa-chevron-up" data-slide-toggle-showing></span><span class="fa fa-chevron-down" data-slide-toggle-hidden></span></button> -->
            </section>
            <ul class="sidebar-nav">
                <li class="sidebar-nav-heading">
                    Components
                </li>
                <li class="sidebar-nav-link ">
                    <a href="/huddle">
                        <span class="typcn typcn-home sidebar-nav-link-logo"></span> Dashboard</a></li><br><br><br>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td style="text-align: center"> <img src="/{{$musicCampaignAudio->artwork}}" height="140" width="140" alt="{{$musicCampaignAudio->song_title}}"></td>
                    </tr>
                    </tbody>
                </table>


                </li>
            </ul>
        </aside>            <header class="top-header">
            <a href="/huddle" class="top-header-logo">
                <span class="text-primary">DJ</span>HUDDLE
            </a>
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

                        <li><a href="../log-in.html"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>
                    </ul>
                </div>
            </nav>
        </header>            <div class="content-wrapper">
            <div class="content-dimmer"></div>
            <div class="container-fluid">
                <!-- START CONTAINER -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td background="/img/1559381892SICK-COVER-2.jpg" style="text-align: center; font-size: 12px; color: #FFFFFF; background-repeat:no-repeat; background-size: cover;"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr background="/img/bck.png">
                                    <td align="left">&nbsp;</td>
                                    <td align="left">{{$musicCampaignAudio->song_title}}</td>
                                    <td align="right"><span style="color: #00D004; font-size: 36px;">${{$musicCampaign->spin_rate/2}}/Spin</span></td>
                                    <td align="right">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="left"><table width="40%" border="2" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr background="/img/bck.png"><span style="text-align: center; font-size: 10px;">
                  <td align="center">                  <table width="426px" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>Campaign Name:</td>
                        <td align="left">{{$musicCampaign->campaign_name}}</td>
                      </tr>
                      <tr>
                        <td>Artist Name:</td>
                        <td align="left">{{$musicCampaignAudio->artist_name}}</td>
                      </tr>
                      <tr>
                        <td>Company Name:</td>
                        <td align="left">{{$musicCampaignAudio->company_name}}</td>
                      </tr>
                      <tr>
                        <td>City:</td>
                        <td align="left">{{\App\City::find($musicCampaign->city)->name}}</td>
                      </tr>
                    </tbody>
                  </table></td>
                </span></tr>
                                            </tbody>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center"><table width="75%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr background="/img/bck.png">
                                                <td align="center"><table width="100%" border="2" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>{{$musicCampaignAudio->song_title}}</td>
                                                                        <td align="right">${{$musicCampaign->spin_rate/2}}/Spin</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table></td>
                                                        </tr>
                                                        </tbody>
                                                    </table></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr background="/img/bck.png">
                                                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr>
                                                            <th width="18%" align="center" style="text-align: center; font-size: 24px;">&nbsp;</th>
                                                            <td colspan="3" align="center">&nbsp;</td>
                                                            <th width="21%" align="center" style="text-align: center; font-size: 24px;">&nbsp;</th>
                                                        </tr>
                                                        <tr>
                                                            <th align="center" style="text-align: center; font-size: 24px;">Likes</th>
                                                            <td colspan="3" rowspan="2" align="center"> <img src="/{{$musicCampaignAudio->artwork}}" height="211" width="211" alt="{{$musicCampaignAudio->song_title}}"></td>
                                                            <th align="center" style="text-align: center; font-size: 24px;">Dislikes</th>
                                                        </tr>
                                                        <tr>
                                                            <th align="center" style="text-align: center; font-size: 24px;"><span style="text-align: center"><img src="/img/thumbup.png" width="68" height="59" alt=""/></span></th>
                                                            <th align="center" style="text-align: center; font-size: 24px;"><span style="text-align: center"><img src="/img/thumbdwn.png" width="70" height="62" alt=""/></span></th>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align: center"><span style="text-align: center; font-size: 36px;" id="likes">{{$musicCampaign->likes}}</span></td>
                                                            <td colspan="3" align="center">&nbsp;</td>
                                                            <td align="center" style="text-align: center"><span style="text-align: center; color: #FFFFFF; font-size: 36px;" id="dislikes">{{$musicCampaign->dislikes}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align: center; font-size: 36px;">&nbsp;</td>
                                                            <td width="21%" align="center">TOTAL DJ SUPPORT</td>
                                                            <td width="19%" align="center"><img src="/img/lightning.png" width="32" height="70" alt=""/></td>
                                                            <th width="21%" align="center" id="accepted-count">{{$acceptedCount}}</th>
                                                            <td align="center" style="text-align: center; color: #FFFFFF; font-size: 36px;">&nbsp;</td>
                                                        </tr>
                                                        </tbody>
                                                    </table></td>
                                            </tr>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </table></td>
                                </tr>
                                </tbody>
                            </table>

                            <footer class="content-wrapper-footer">
                                &copy; Copyright 2019 SpinStatz by Otomation Systems LLC.
                            </footer>    <!-- END CONTAINER -->
            </div>

        </div>
    </div>
</div>
<script src="/js/Chart.min.js"></script>
<script src="/js/jquery-1.12.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.piety.min.js"></script>
<script src="/js/varello-theme.js"></script>
<script src="/js/icheck.min.js"></script>
<script src="/js/dropdown.js"></script></body>
</html>
