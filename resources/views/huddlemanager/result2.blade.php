
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link  rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/resources/font-awesome.min.css">
<link rel="stylesheet" href="/resources/typicons.min.css">
    <link rel="stylesheet" href="/css/varello-theme.min.css">
    <link rel="stylesheet" href="/css/varello-skins.min.css">
<link rel="stylesheet" href="/resources/animate.min.css">
    <link rel="stylesheet" href="/css/typicons.min.css">
<link rel="stylesheet" href="/resources/icheck-all-skins.css">
<link rel="stylesheet" href="/resources/_all.css">
<link href="/resources/css" rel="stylesheet" type="text/css">

<meta name="theme-color" content="#ffffff">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
        .sidebar-cover{
            padding: 10px 17px;
        }
        .sidebar-cover img{
            width: 100%;
        }

          .dropdown-menu-notifications-item-content span {  display: inline-block;  vertical-align: middle; padding: 0;}
  .dropdown-menu-notifications-item-content p { margin: 0;  padding-left: 10px;}
  .dropdown-menu-notifications-item-content span p:first-child{ font-weight: bold; color: #1CA2CE; }
  .dropdown-menu.dropdown-menu-notifications {  padding: 0 !important; }
  .dropdown-menu-notifications a {  padding: 7px 15px !important; }
  .dropdown-menu.dropdown-menu-notifications li { background: #2f3638; }
  .dropdown-menu.dropdown-menu-notifications li:nth-child(2n) { background: #424445; }
    </style>

<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
</head>
<body cz-shortcut-listen="true" class="">

<div class="notifications top-right"></div>
<div class="page-wrapper">
    <aside class="left-sidebar" style="min-height: 597px;">
        <section class="sidebar-user-panel">
            <div id="user-panel-slide-toggleable">
                <div class="logo_hudle">
                <img src="/resources/Huddle.png">
                </div>

            </div>
            <!-- <button class="user-panel-toggler" data-slide-toggle="user-panel-slide-toggleable"><span class="fa fa-chevron-up" data-slide-toggle-showing></span><span class="fa fa-chevron-down" data-slide-toggle-hidden></span></button> -->
        </section>

        <ul class="sidebar-nav">
    <li class="sidebar-nav-heading components"> Components</li>
    <li class="sidebar-nav-link dashboard">
        <a href="https://spinstatz.net/advertiser">
            <span class="typcn typcn-home sidebar-nav-link-logo "></span> Campaigns
        </a>
    </li>

</ul>
<div class="sidebar-cover">

    <img src="/{{$musicCampaignAudio->artwork}}" />
</div>
</aside>
    <header class="top-header">
        <a href="https://spinstatz.net/" class="top-header-logo" style="position: fixed">
            <span class="text-primary">
            </span>
        </a>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar=""><span class="typcn typcn-arrow-left visible-sidebar-sm-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span> <span class="typcn typcn-arrow-left visible-sidebar-md-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-md-closed"></span></button>
                </div>

                <ul class="nav navbar-nav navbar-right " data-dropdown-in="flipInX" data-dropdown-out="zoomOut">

                    <li><a href="https://spinstatz.net/logout"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="content-wrapper" style="min-height: 505px; background: url('/{{$musicCampaignAudio->artwork}}') no-repeat;    background-size: cover;">
        <div style="padding-top: 70px">
        <div class="content-dimmer">

        </div>


<style type="text/css">
              .table-hover thead tr:hover th, .table-hover tbody tr:hover td {
                  background-color: #D1D119;
              }

                .dataTables_filter label {
                    color: #fff;
                    float: right;
                }

                .dataTables_length select, input {
                    background-color: #3a4144;
                    /*border: 0.2px solid #fff;*/
                    padding: 3px;
                }

                .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                    padding: 3px !important;
                }
                .widget_search {
                    margin-top: 35px;
                    position: relative;
                    margin-right: 12px;
                }
                #search_loader {
                    position: absolute;
                    right: 5px;
                    top: 6px;
                    font-size: 17px;
                 }
                .paginate_enabled_next {
                  float: right;
                }
                .logo_hudle{
                    height: auto;
                    text-align: center;
                    width: 100%;
                }
                .title-bar{
                    min-height: 60px;
                    background: rgba(255,255,255,0.3);
                }
                .border-bar{
                    height: 69px;
                    padding: 4px;

                }
                .inner-title{
                    height: 100%;
                    border: 2px solid #fff;
                    background: rgba(0,0,0,0.5);
                }
                .white-tit{
                    float: left;
                }
                .green-tit{
                    text-align: right;
                    color: #13ef13;
                    font-size: 45px;
                    margin-top: 4px;
                    float: right;
                }
                .no-padding{
                    padding: 0px;
                }
                .detail-sect{
                    margin-top: 42px;
                    padding: 10px;
                    background: rgba(0,0,0,0.5);
                    border: 2px solid #fff;
                }
                .detail-sect p{
                    margin: 0px;
                    font-weight: 500;
                }
                .detail-sect p span{
                    margin: 0px;
                    font-weight: 300;
                }
                .bot-sect{
                    margin-top: 42px;
                    padding: 5px;
                    background: rgba(0,0,0,0.5);
                    border: 2px solid #fff;
                    height: 35px;
                }
                .sec-bot{
                    margin-top: 10px;
                    padding: 5px;
                    background: rgba(0,0,0,0.5);
                    padding-top: 18px;
                    height: 271px;
                }
                .twenty-perc{
                    width: 25%;
                    float: left;
                    text-align: center;
                }
                .twenty-perc h1{
                    font-size: 56px;
                    margin-top: 20px;
                }
                .fifty-perc{
                    float: left;
                    width: 50%;
                }
                .like{
                    font-size: 30px;
                }
                .total{
                    padding: 5px;
                    background: rgba(0,0,0,0.5);
                    padding-top: 10px;
                    padding-bottom: 8px;
                    margin-top: 8px;
                }
                @media only screen and (max-width: 600px) {

                    .sec-bot {
                        margin-top: 10px;
                        padding: 5px;
                        background: rgba(0,0,0,0.5);
                        padding-top: 18px;
                        height: 210px;
                    }
                    .like {
                            font-size: 19px;
                        }
                        .twenty-perc h1 {
                            font-size: 39px;
                            margin-top: 20px;
                        }
                }
            </style>
<div class="container-fluid">
        <div class="row">
        <div class="title-bar">
            <div class="border-bar">
                <div class="inner-title">
                    <div class="col-sm-12">
                        <h1 class="white-tit">{{$musicCampaign->campaign_name}}</h1>
                        <h1 class="green-tit">${{$musicCampaign->spin_rate/2}}/SPINg</h1>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-sm-6 no-padding">
            <div class="detail-sect">
                <p>CAMPAIGN NAME: <span>{{$musicCampaign->campaign_name}}</span></p>
                <p>ARTIST NAME: <span>{{$musicCampaignAudio->artist_name}}</span></p>
                <p>COMPANY NAME: <span>{{$musicCampaignAudio->company_name}}</span></p>
                <p>CITY: <span>{{\App\City::find($musicCampaign->city)->name}}</span></p>
            </div>

        </div>
        <div class="col-sm-12"></div>

        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="bot-sect">
                <p style="float: left">{{$musicCampaignAudio->song_title}}</p>
                <p style="float: right">${{$musicCampaign->spin_rate/2}}/Spin</p>
            </div>

            <div class="sec-bot">
                <div class="twenty-perc">
                    <p class="like">Likes</p>
                    <img src="/resources/thumbup.png"/>
                    <h1 id="likes">{{$musicCampaign->likes}}</h1>
                </div>

                <div class="fifty-perc">
                        <img style="width: 100%" src="/{{$musicCampaignAudio->artwork}}">
                </div>

                <div class="twenty-perc">
                        <p class="like">DisLikes</p>
                        <img src="/resources/thumbdwn.png"/>
                        <h1 id="dislikes">{{$musicCampaign->dislikes}}</h1>

                </div>


            </div>

            <div class="total">
                <h1 style="text-align: center">TOTAL DJS SIGNED ON</h1>
            </div>
            <h1 style="text-align: center; font-size:67px;"><img src="/resources/lightning.png" /> <span id="accepted-count"> {{$acceptedCount}} </span></h1>
        </div>
        <div class="col-sm-3"></div>



      </div>


  <script>
  $(function(){
    var table = $("#example").dataTable();
   // $('input')[2].focus()

    var time = $("#played_timestamp").text()
    d = new Date(parseInt(time)*1000);
    $("#played_timestamp").html(d)

  })
  </script>
            <script src="/resources/notification.js"></script>
        </div>

    </div>
</div>

<div class="wrapper">
    <script src="/resources/Chart.min.js"></script>
    <script src="/resources/bootstrap.min.js"></script>

    <script src="/resources/varello-theme.js"></script>
    <script src="/resources/icheck.min.js"></script>
    <script src="/resources/dropdown.js"></script>

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

<!-- <footer class="content-wrapper-footer"> © Copyright 2017 SpinStatz <a href="https://spinstatz.net/keyer#" target="_blank">OttoMation
        Solutions LLC</a>.
</footer> -->
</div></body></html>
