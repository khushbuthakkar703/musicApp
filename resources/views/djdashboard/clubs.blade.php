@php($currentUser = Auth::user())
<html><head>
        <meta charset="utf-8">
        <title>SpinStatz</title>

		<link rel="stylesheet" href="/css/custom.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/typicons.min.css">
        <link rel="stylesheet" href="/css/clubs.css">
        <link rel="stylesheet" href="/css/clubs2.css">
        <link rel="stylesheet" href="/css/animate.min.css">
        <link rel="stylesheet" href="/css/icheck-all-skins.css">
        <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
        <link rel="stylesheet" href="/countdown/css/style.default.css" id="theme-stylesheet">
        <script src="/js/jquery-1.12.3.min.js"></script>

        <!-- Validetta CSS -->        
        <link href="/css/validetta.css" type="text/css" rel="stylesheet"/>
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
        <meta name="theme-color" content="#ffffff">        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
    </head>
    <body>
                <div class="notifications top-right"></div>
    <div class="page-wrapper">
                  <aside class="left-sidebar" style="min-height: 280px;">
                    <section class="sidebar-user-panel">
                      <div id="user-panel-slide-toggleable">
						  <div class="container" id="con" style="margin-top:0px">
        <img src="/images/logoicon.png" id="image" alt="" style="height: 135px;">
        <!-- <img src="img_avatar.png" alt="Avatar" class="image"> -->
        
      </div>
                        
                      </div>
                      <!-- <button class="user-panel-toggler" data-slide-toggle="user-panel-slide-toggleable"><span class="fa fa-chevron-up" data-slide-toggle-showing></span><span class="fa fa-chevron-down" data-slide-toggle-hidden></span></button> -->
                    </section>
                    <ul class="sidebar-nav">
						<p style="font-size: 19px; font-weight: 500; margin-bottom: 25px !important; color:rgb(132, 255, 255)" class="my-4 mb-0 pl-15">&nbsp;Menu</p>
                        <li class="sidebar-nav-link"><a href="/dj/dashboard"> <span
                            class="typcn typcn-home sidebar-nav-link-logo"></span> Dashboard </a>
                        </li>
                        <li class="sidebar-nav-link "><a href="/dj/profile/edit"> <span
                            class="typcn typcn-user-add sidebar-nav-link-logo"></span> Update Profile </a></li>
                      
                    </ul>
                  </aside>
                  <header class="top-header"> <a href="/" class="top-header-logo" style="margin-top:10px"> <span class="text-primary"><img src="/images/SpinstatsApplogo.png" width="144" height="26.5" alt=""></span></a>
                    <nav class="navbar navbar-default">
                      <div class="container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar=""> <span class="typcn typcn-arrow-left visible-sidebar-sm-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span> <span class="typcn typcn-arrow-left visible-sidebar-md-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-md-closed"></span> </button>
                        </div>
                       
                        <ul class="nav navbar-nav navbar-right" data-dropdown-in="flipInX" data-dropdown-out="zoomOut">
                          <li class="hidden-sm hidden-xs hidden-md"><a href="#">Welcome to <strong>SpinStatz</strong></a></li>
						<li><a href="/logout"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>
    <li class="item-feed dropdown"> <a href="#" class="item-feed-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-messages">
                              <li> <a class="dropdown-menu-messages-item" href="#">
                                
                          </li>
                          <li class="item-feed dropdown"> <a href="#" class="item-feed-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="badge badge-danger item-feed-badge">7</span></a> 
                            
                          </li>
                          
                        </ul>
                      </div>
                    </nav>
                  </header>
      <div class="content-wrapper " style="min-height: 133px; font-size: 16px;">
    
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
		<div class="paydiv">  <img src="/images/pay.png" class="pay"/></div>
<div class="container-fluid my_container_fluid">  
<div class="content-dimmer"></div> 
	
<div class="table-responsive">
  <h3 id="user-dashboard ml-unset">ADD YOUR VENUE OR EVENT INFORMATION</h3></div>


	<div><strong>Step 1.</strong>&nbsp;&nbsp;<a style="color: rgb(132, 255, 255); border: 1px solid;" data-toggle="modal" data-target="#myModal" class="btn mt-4 float-right add_funds_btn" role="button">ADD VENUE</a> Enter as many venues or locations where you will be DJing.
		<br><br><strong>Step 2.</strong>&nbsp;&nbsp;<a style="color: rgb(132, 255, 255); border: 1px solid;" href="/dj/profile/edit/" class="btn mt-4 float-right add_funds_btn" role="button">UPDATE PROFILE</a>&nbsp;and completely fill out your DJ profile.
<br><br><strong>Step 3.</strong>&nbsp;&nbsp; Download and install our mobile app. <a style="color: rgb(132, 255, 255); border: 1px solid;"href="https://apps.apple.com/us/app/spinstatz/id1458997474" class="btn mt-4 float-right add_funds_btn" role="button">IOS</a> &nbsp; <a style="color: rgb(132, 255, 255); border: 1px solid;"href="https://play.google.com/store/apps/details?id=com.mtecsoft.spinstatz&hl=en_US&gl=US" class="btn mt-4 float-right add_funds_btn" role="button">Android</a><BR><BR>
		 <div style="color: rgb(132, 255, 255); text-align: center;"></div>
		
		
    
</div>
    <table class="col-md-12 mt-4 mb-4 mt-0 sm-plpr-0 table_view" role="table">
     <thead role="rowgroup">
         <tbody style="border-bottom: 1px solid grey;" role="rowgroup" class="spin-details">
          <tr role="row">
             <th role="columnheader" >&nbsp;</th>
             <th role="columnheader" >Venue</th>
             <th role="columnheader" >Prime Time</th>
             <th role="columnheader" class="hidden-xs hidden-sm">Address</th>
             <th role="columnheader" class="hidden-xs hidden-sm">Country</th>
             <th role="columnheader" >State</th>
             <th role="columnheader" >City</th>
             <th role="columnheader" class="hidden-xs hidden-sm">Capacity</th>
             <th role="columnheader" class="hidden-xs hidden-sm">Contact</th>
             <th role="columnheader" class="hidden-xs hidden-sm">Phone No</th>
             <th role="columnheader" colspan="2" class="text-center">
                Actions 
            </th>
        </tr>
			</tbody>
        </thead>
        <tbody style="border-bottom: 1px solid grey;" role="rowgroup" class="spin-details">
        @foreach($clubs as $club)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$club->name}}</td>
                <td>{{$club->prime_time}}</td>
                <td class="hidden-xs hidden-sm">{{$club->address}}</td>
                <td class="hidden-xs hidden-sm">{{$club->country}}</td>
                <td>{{$club->state}}</td>
                <td>{{$club->city_name}}</td>
                <td class="hidden-xs hidden-sm">{{$club->capacity}}</td>
                <td class="hidden-xs hidden-sm">{{$club->contact}}</td>
                <td class="hidden-xs hidden-sm">{{$club->phone_no}}</td>
                <td>
                    <a href="/dj/club/edit/{{$club->id}}">
                        <button class="btn btn-transparent btn-xs"></span> <span class="hidden-xs hidden-sm hidden-md">Edit</span>
                        </button>
                    </a>
                </td>
                <td>
                    <a href="/dj/club/delete/{{$club->id}}">
                    <button class="btn btn-xs btn-danger"></span> <span class="hidden-xs hidden-sm hidden-md">Delete</span>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
        
<div class="modal fade" id="myModal" role="dialog">
   <br> <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Venue</h4>
            </div>
	    <div>IMPORTANT:It is a requirement that ALL Clubs and Stations entered average a minimum of 100 people in attendance at your venue or listening to your broadcast. We MUST verify ALL Online Station stats.</div>
            <form method="post" action="/djlogin/success" id="form">
            <div class="modal-body">
                <div class="form-group {{ $errors->has('clubname') ? ' has-error' : '' }}">
                    <input type="text" class="form-control input-lg" name="clubname" id="clubname" placeholder="Club Name/Station Name" name="clubname" value="" data-validetta="required">                    
                    @if ($errors->has('clubname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('clubname') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('prime_time') ? ' has-error' : '' }}">
                    <div id="datetimepickerDate" class="input-group timerange">
                    <input class="form-control" type="text" placeholder="Select Club Prime Time" name="prime_time" onkeydown="return false" data-validetta="required">                    
                        <span class="input-group-addon" style="">
                        <i aria-hidden="true" class="fa fa-calendar"></i>
                    </span>
                </div>

                </div>

                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                    <input type="text" class="form-control input-lg" name="address" id="address" placeholder="Address" name="address" value="" data-validetta="required">
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group" role="group">
                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle countryOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="country" data-validetta="required">
                  </select>
                  <small><em>Choose Your Country</em></small>
                </div>
                <div class="form-group" role="group">
                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle stateOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-validetta="required">
                  </select>
                  <small><em>Choose Your State</em></small>
                </div>
                
                <div class="form-group" role="group">
                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle cityOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" id="cityOption" data-validetta="required">
                  </select>
                  <small><em>Choose Your City</em></small>
                </div>
                @if ($errors->has('city'))
                    <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('capacity') ? ' has-error' : '' }}">
                    <input type="text" class="form-control input-lg" name="capacity" id="capacity" placeholder="Capacity - Enter Numbers ONLY" name="capacity" value="" data-validetta="required,number">
                    @if ($errors->has('capacity'))
                        <span class="help-block">
                            <strong>{{ $errors->first('capacity') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('phone_no') ? ' has-error' : '' }}">
                    <input type="text" class="form-control input-lg" name="phone_no" id="phone_no" placeholder="Phone no"  value="" data-validetta="required">
                    @if ($errors->has('phone_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_no') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('contact') ? ' has-error' : '' }}">
                    <input type="text" class="form-control input-lg" name="contact" id="contact" placeholder="Contact Person"  value="" data-validetta="required">
                    @if ($errors->has('contact'))
                        <span class="help-block">
                            <strong>{{ $errors->first('contact') }}</strong>
                        </span>
                    @endif
                </div>
                {{ csrf_field() }}

                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" value="Submit">
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

                  </div>
    </div>
    <div class="wrapper"></div>
      
<script src="/js/Chart.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.piety.min.js"></script>
<script src="/js/varello-theme.js"></script>
<script src="/js/icheck.min.js"></script>
<script src="{{asset('js/validetta.js')}}"></script>
<script src="/js/dropdown.js"></script></small>
</div>

<footer class="content-wrapper-footer">
&copy; Copyright 2020 SpinStatz <a href="#" target="_blank">OttoMation Solutions LLC&nbsp;&nbsp;  </a>
</footer>
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

<style type="text/css">
    
.timerangepicker-container {
  display:flex;
  position: absolute;
  background: #34788d;
}
.timerangepicker-label {
  display: block;
  line-height: 2em;
  background-color: #c8c8c880;
  padding-left: 1em;
  border-bottom: 1px solid grey;
  margin-bottom: 0.75em;
}

.timerangepicker-from,
.timerangepicker-to {
  background-color: #393B42;
	border: 1px solid grey;
  padding-bottom: 0.75em;
  float: left;
}
.timerangepicker-from {
  border-right: none;
}
.timerangepicker-display {
  box-sizing: border-box;
  display: inline-block;
  width: 2.5em;
  height: 2.5em;
  border: 1px solid grey;
  line-height: 2.5em;
  text-align: center;
  position: relative;
  margin: 1em 0.175em;
  
}
.timerangepicker-display .increment,
.timerangepicker-display .decrement {
  cursor: pointer;
  position: absolute;
  font-size: 1.5em;
  width: 1.5em;
  text-align: center;
  left: 0;
}

.timerangepicker-display .increment {
  margin-top: -0.25em;
  top: -1em;
}

.timerangepicker-display .decrement {
  margin-bottom: -0.25em;
  bottom: -1em;
}

.timerangepicker-display.hour {
  margin-left: 1em;
}
.timerangepicker-display.period {
  margin-right: 1em;
}
</style>

<script type="text/javascript">
      $('.timerange').on('click', function(e) {
    e.stopPropagation();
    var input = $(this).find('input');

    var now = new Date();
    var hours = now.getHours();
    var period = "PM";
    if (hours < 12) {
      period = "AM";
    } else {
      hours = hours - 11;
    }
    var minutes = now.getMinutes();

    var range = {
      from: {
        hour: hours,
        minute: minutes,
        period: period
      },
      to: {
        hour: hours,
        minute: minutes,
        period: period
      }
    };

    if (input.val() !== "") {
      var timerange = input.val();
      var matches = timerange.match(/([0-9]{2}):([0-9]{2}) (\bAM\b|\bPM\b)-([0-9]{2}):([0-9]{2}) (\bAM\b|\bPM\b)/);
      if( matches.length === 7) {
        range = {
          from: {
            hour: matches[1],
            minute: matches[2],
            period: matches[3]
          },
          to: {
            hour: matches[4],
            minute: matches[5],
            period: matches[6]
          }
        }
      }
    };
    console.log(range);


    var html = '<div class="timerangepicker-container">'+
      '<div class="timerangepicker-from">'+
      '<label class="timerangepicker-label">From:</label>' +
      '<div class="timerangepicker-display hour">' +
          '<span class="increment fa fa-angle-up"></span>' +
          '<span class="value">'+('0' + range.from.hour).substr(-2)+'</span>' +
          '<span class="decrement fa fa-angle-down"></span>' +
      '</div>' +
      ':' +
      '<div class="timerangepicker-display minute">' +
          '<span class="increment fa fa-angle-up"></span>' +
          '<span class="value">'+('0' + range.from.minute).substr(-2)+'</span>' +
          '<span class="decrement fa fa-angle-down"></span>' +
      '</div>' +
      ':' +
      '<div class="timerangepicker-display period">' +
          '<span class="increment fa fa-angle-up"></span>' +
          '<span class="value">PM</span>' +
          '<span class="decrement fa fa-angle-down"></span>' +
      '</div>' +
      '</div>' +
      '<div class="timerangepicker-to">' +
      '<label class="timerangepicker-label">To:</label>' +
      '<div class="timerangepicker-display hour">' +
          '<span class="increment fa fa-angle-up"></span>' +
          '<span class="value">'+('0' + range.to.hour).substr(-2)+'</span>' +
          '<span class="decrement fa fa-angle-down"></span>' +
      '</div>' +
      ':' +
      '<div class="timerangepicker-display minute">' +
          '<span class="increment fa fa-angle-up"></span>' +
          '<span class="value">'+('0' + range.to.minute).substr(-2)+'</span>' +
          '<span class="decrement fa fa-angle-down"></span>' +
      '</div>' +
      ':' +
      '<div class="timerangepicker-display period">' +
          '<span class="increment fa fa-angle-up"></span>' +
          '<span class="value">PM</span>' +
          '<span class="decrement fa fa-angle-down"></span>' +
      '</div>' +
      '</div>' +
    '</div>';

    $(html).insertAfter(this);
    $('.timerangepicker-container').on(
      'click',
      '.timerangepicker-display.hour .increment',
      function(){
        var value = $(this).siblings('.value');
        value.text(
          increment(value.text(), 12, 1, 2)
        );
      }
    );

    $('.timerangepicker-container').on(
      'click',
      '.timerangepicker-display.hour .decrement',
      function(){
        var value = $(this).siblings('.value');
        value.text(
          decrement(value.text(), 12, 1, 2)
        );
      }
    );

    $('.timerangepicker-container').on(
      'click',
      '.timerangepicker-display.minute .increment',
      function(){
        var value = $(this).siblings('.value');
        value.text(
          increment(value.text(), 59, 0 , 2)
        );
      }
    );

    $('.timerangepicker-container').on(
      'click',
      '.timerangepicker-display.minute .decrement',
      function(){
        var value = $(this).siblings('.value');
        value.text(
          decrement(value.text(), 59, 0, 2)
        );
      }
    );

    $('.timerangepicker-container').on(
      'click',
      '.timerangepicker-display.period .increment, .timerangepicker-display.period .decrement',
      function(){
        var value = $(this).siblings('.value');
        var next = value.text() == "PM" ? "AM" : "PM";
        value.text(next);
      }
    );

  });
    
  $(document).on('click', function(e){

    if(!$(e.target).closest('.timerangepicker-container').length) {
      if($('.timerangepicker-container').is(":visible")) {
        var timerangeContainer = $('.timerangepicker-container');
        if(timerangeContainer.length > 0) {
          var timeRange = {
            from: {
              hour: timerangeContainer.find('.value')[0].innerText,
              minute: timerangeContainer.find('.value')[1].innerText,
              period: timerangeContainer.find('.value')[2].innerText
            },
            to: {
              hour: timerangeContainer.find('.value')[3].innerText,
              minute: timerangeContainer.find('.value')[4].innerText,
              period: timerangeContainer.find('.value')[5].innerText
            },
          };

          timerangeContainer.parent().find('input').val(
            timeRange.from.hour+":"+
            timeRange.from.minute+" "+    
            timeRange.from.period+"-"+
            timeRange.to.hour+":"+
            timeRange.to.minute+" "+
            timeRange.to.period
          );
          timerangeContainer.remove();
        }
      }
    }
    
  });

  function increment(value, max, min, size) {
    var intValue = parseInt(value);
    if (intValue == max) {
      return ('0' + min).substr(-size);
    } else {
      var next = intValue + 1;
      return ('0' + next).substr(-size);
    }
  }

  function decrement(value, max, min, size) {
    var intValue = parseInt(value);
    if (intValue == min) {
      return ('0' + max).substr(-size);
    } else {
      var next = intValue - 1;
      return ('0' + next).substr(-size);
    }
  }
</script>
</body>
<script src="/countdown/js/jquery.cookie.js"></script>
<script src="/countdown/js/jquery.countdown.min.js"></script>
<script src="/countdown/js/front.js"></script>
</html>
<script >
$('#form').validetta({
  validators: {
                regExp: {
                    password: {
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/,
                        errorMessage: 'Password must include uppercase, lowercase and number'
                    }
                }
        }
});
</script>
<script src="/js/locationchooser.js"></script>
