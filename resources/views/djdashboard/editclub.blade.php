@php($currentUser = Auth::user())
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit Club</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/typicons.min.css">
        <link rel="stylesheet" href="/css/varello-theme.min.css">
        <link rel="stylesheet" href="/css/varello-skins.min.css">
        <link rel="stylesheet" href="/css/animate.min.css">
        <link rel="stylesheet" href="/css/icheck-all-skins.css">
        <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
        <link rel="stylesheet" href="/countdown/css/style.default.css" id="theme-stylesheet">

        <!-- Validetta CSS -->
        <script src="/js/jquery-1.12.3.min.js"></script>
        <link href="/css/validetta.css" type="text/css" rel="stylesheet"/>
        <script src="{{asset('/js/validetta.js')}}"></script>
        <script >$("#form").validetta();</script>
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
                        <div class="user-panel-profile-picture"> <img src="{{$currentUser->profile_picture}}" alt="{{$currentUser->name}}"> </div>
                        <span class="user-panel-logged-in-text"><span class="fa fa-circle-o text-success user-panel-status-icon"></span> Logged in as <strong> {{$currentUser->username}}</strong></span> 
                          </div>
                      <!-- <button class="user-panel-toggler" data-slide-toggle="user-panel-slide-toggleable"><span class="fa fa-chevron-up" data-slide-toggle-showing></span><span class="fa fa-chevron-down" data-slide-toggle-hidden></span></button> -->
                    </section>
                    <ul class="sidebar-nav">
                      
                    </ul>
                  </aside>
                  <header class="top-header"> <a href="/" class="top-header-logo"> <span class="text-primary"><img src="/img/mini logo.png" width="112" height="45" alt=""></span></a>
                    <nav class="navbar navbar-default">
                      <div class="container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar=""> <span class="typcn typcn-arrow-left visible-sidebar-sm-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span> <span class="typcn typcn-arrow-left visible-sidebar-md-open"></span> <span class="typcn typcn-arrow-right visible-sidebar-md-closed"></span> </button>
                        </div>
                        
                        <ul class="nav navbar-nav navbar-right" data-dropdown-in="flipInX" data-dropdown-out="zoomOut">
                          <li class="hidden-sm hidden-xs hidden-md"><a href="#">Welcome to <strong>SpinStatz</strong>Admin.</a></li>
                          <li class="item-feed dropdown"> <a href="#" class="item-feed-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-messages">
                              <li> <a class="dropdown-menu-messages-item" href="#">
                                
                          </li>
                          <li class="item-feed dropdown"> <a href="#" class="item-feed-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="badge badge-danger item-feed-badge">7</span></a>
                            
                          </li>
                          <li><a href="/logout"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>
                        </ul>
                      </div>
                    </nav>
                  </header>
      <div class="content-wrapper" style="min-height: 133px;">
    
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
<div class="container-fluid">  
<div class="content-dimmer"></div>
    <form method="post" action="/dj/club/update/{{$club->id}}" class="form-horizontal" id="form">
      <div class="form-group"><h2>Edit Club details</h2></div>
        <div class="form-group {{ $errors->has('clubname') ? ' has-error' : '' }} col-md-8">
            <label for="clubname" class="control-label col-sm-2">Club Name</label>
            <div class="col-sm-8">
                <input class="form-control" name="clubname" id="clubname" placeholder="Club Name" name="clubname" value="{{$club->name}}" data-validetta="required|text">
                @if ($errors->has('clubname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('clubname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        @if($currentUser->role != 'dj')
        <div class="form-group {{ $errors->has('prime_time') ? ' has-error' : '' }} col-md-8">
            <label for="clubname" class="control-label col-sm-2">Club Prime Time</label>
            <div id="datetimepickerDate" class="input-group timerange  col-md-8">
                <input class="form-control prime_time" type="text" placeholder="Select Club Prime Time" name="prime_time" onkeydown="return false" value="{{$club->prime_time}}" data-validetta="required">
                <span class="input-group-addon" style="">
                    <i aria-hidden="true" class="fa fa-calendar"></i>
                </span>
            </div>

        </div>
        @endif

        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }} col-md-8">
            <label for="clubname" class="control-label col-sm-2">Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control input-lg" name="address" id="address" placeholder="Address" name="address" value="{{$club->address}}" data-validetta="required|text">
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group col-md-8" role="group">
            <label for="clubname" class="control-label col-sm-2">Country</label>
            <div class="col-sm-8">
                <select id="btnGroupVerticalDrop1 " type="button" class="form-control btn btn-default dropdown-toggle countryOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="country" val="{{$country->id}}">
                </select>
            </div>
        </div>

        <div class="form-group col-md-8" role="group">
            <label for="clubname" class="control-label col-sm-2">State</label>
            <div class="col-sm-8">
                <select id="btnGroupVerticalDrop1 " type="button" class="form-control btn btn-default dropdown-toggle stateOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$state->id}}">
                </select>
            </div>
        </div>

        <div class="form-group col-md-8" role="group">
            <label for="clubname" class="control-label col-sm-2">City</label>
            <div class="col-sm-8">
                <select id="btnGroupVerticalDrop1 " type="button" class="form-control btn btn-default dropdown-toggle cityOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" val="{{$club->city}}">
                </select>
        @if ($errors->has('city'))
            <span class="help-block">
            <strong>{{ $errors->first('city') }}</strong>
        </span>
        @endif
        </div>
        </div>  
        </div>

        
        <div class="form-group {{ $errors->has('capacity') ? ' has-error' : '' }} col-md-8">
            <label for="clubname" class="control-label col-sm-2">Capacity</label>
            <div class="col-sm-8">
            <input type="number" class="form-control input-lg" name="capacity" id="capacity" placeholder="capacity" name="capacity" value="{{$club->capacity}}" required>
            @if ($errors->has('capacity'))
                <span class="help-block">
                    <strong>{{ $errors->first('capacity') }}</strong>
                </span>
            @endif
        </div>
        </div>

        <div class="form-group {{ $errors->has('phone_no') ? ' has-error' : '' }} col-md-8">
            <label for="clubname" class="control-label col-sm-2">Phone No</label>
            <div class="col-sm-8">
            <input type="Phone" class="form-control input-lg" name="phone_no" id="phone_no" placeholder="phone_no"  value="{{$club->phone_no}}" required>
            @if ($errors->has('phone_no'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone_no') }}</strong>
                </span>
            @endif
        </div>
        </div>

        <div class="form-group {{ $errors->has('contact') ? ' has-error' : '' }} col-md-8">
            <label for="clubname" class="control-label col-sm-2">Contact Person</label>
            <div class="col-sm-8">
            <input type="text" class="form-control input-lg" name="contact" id="contact" placeholder="Contact Person"  value="{{$club->contact}}" required>
            </div>
            @if ($errors->has('contact'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact') }}</strong>
                </span>
            @endif
        </div>
        {{ csrf_field() }}

        <div class="modal-footer col-md-8">
            <input type="submit" class="btn btn-default" value="Submit">
        </div>
    
        </form>                

</div>
</div>
<div class="wrapper"></div>
<script src="/js/Chart.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.piety.min.js"></script>
<script src="/js/varello-theme.js"></script>
<script src="/js/icheck.min.js"></script>
<script src="/js/locationchooser.js"></script>
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
          decrement(value.text(), 12, 1, 2)
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

  $(document).on('click', e => {

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
</html>

<script src="/js/locationchooser.js"></script>
