<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SpinStatz | Register</title>
    <link rel="stylesheet" href={{asset("/css/bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("/css/font-awesome.min.css")}}>
    <link rel="stylesheet" href={{asset("/css/typicons.min.css")}}>
    <link rel="stylesheet" href={{asset("/css/varello-theme.min.css")}}>
    <link rel="stylesheet" href={{asset("/css/varello-skins.min.css")}}>
    <link rel="stylesheet" href={{asset("/css/animate.min.css")}}>
    <link rel="stylesheet" href={{asset("/css/icheck-all-skins.css")}}>
    <link rel="stylesheet" href={{asset("/css/icheck-skins/flat/_all.css")}}>
    <link href='https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300' rel='stylesheet' type='text/css'>    <link rel="apple-touch-icon" sizes="57x57" href="../apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="manifest" href="../manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>

</head>
<style>

    /* 18-07-2018 */
    .header img { max-width: 200px; margin: 0 auto;}
    .header{ background:#111111; text-align: center; }
    .log-in-wrapper img{margin-top: 0px;
        background: #111;width: 100%}
    .log-in-wrapper .validetta-bubble { min-width: 200px;}
    .log-in-wrapper .validetta-bubble {
        position: absolute;
        background-color: #e6e6e6;
        max-width: 325px;
        /* border-radius: 5px; */
        color: red;
        padding: 5px 12px;
        z-index: 9;
        border-top: 2px solid red;
        border-radius: 1px;
    }
    .log-in-wrapper h1 {padding: 20px; margin-bottom: -20px}
    .log-in-wrapper form select option{ color:#fff; }
    .log-in-wrapper select {   -moz-appearance: none;  /* for Chrome */  -webkit-appearance: none; text-align:left; position:relative; }
    .log-in-wrapper .select_group{ position:relative; }
    .log-in-wrapper .select_group::after {  content: "\f0dc"; font-family: FontAwesome; color: #bfbfbf; /* padding: 12px 8px; */  position: absolute; right: 1px; top: 1px; z-index: 1; text-align: center; width: 25px;  pointer-events: none; box-sizing: border-box; height: 32px; line-height: 38px;  text-align: center; padding-left: 2px;}
    .log-in-wrapper form input,.log-in-wrapper form select { background: #40484b;
        border: 0;
        border-radius: 0px;
        border: 1px solid #333; }
    .log-in-wrapper {    background: rgba(255, 255, 255, 0.05); width: 700px;    padding: 0px; box-shadow: 0px 0px 10px rgba(0,0,0,0.3); }
    body .log-in-wrapper select:focus,body .log-in-wrapper select:active,body .log-in-wrapper select:hover{ background:#40484b; color:#fff; box-shadow:none; border:1px solid rgba(255, 255, 255, 0.2); }
    .log-in-wrapper tbody{   }
    .log-in-wrapper .submit_button {text-align: center;padding: 20px;margin: 0 auto;   }
    .log-in-wrapper .submit_button input {width: 200px; margin:0 auto; }
    .log-in-wrapper .submit_button input {  background: #000; border: 0; }
    .form-control,select{ height:40px !important; font-size: 16px; }
    .form-group { margin-bottom: 20px; }
    #form{ padding: 20px; padding-bottom: 0px; }
    table{ margin-top: 15px; }
    table .form-group{ margin-bottom: 0px; }
    table .form-group label { left: -39px; top:3px; }
    .terms-and-condition {  margin-top: 20px;}
    .terms-and-condition input{ margin-right: 10px; }
    .footer-design{ background: #40484b;margin: 0px -20px;    margin-top: 0px;margin-top: 17px;}
    .login-bottom-links{ margin: 0;    margin-top: 0px;padding: 0;    padding-right: 0px;text-align: right;padding-right: 14px;margin-top: -20px; }
    .log-in-wrapper .submit_button input{ }
    .icheck-label{ font-size: 14.5px !important; }
    .terms-and-condition {  margin-top: 20px; border-top: 1px solid #40484b;  padding-top: 12px;}
    @media screen and (max-width:990px){
        .log-in-wrapper .validetta-bubble { min-width: auto; padding: 3px 7px; position: static;    width: 100%;    max-width: none;    border-radius: 0;   font-style: italic;}
        .log-in-wrapper .validetta-bubble::before { border-style: none; }
        .log-in-wrapper img{margin-top: 0px;
            background: #111;width: 100%}
        .log-in-wrapper form input,.log-in-wrapper form select { background: #222;
            border: 0;
            border-radius: 0px;
            border: 1px solid #333; }
    }

    @media screen and (max-width:768px){
        .log-in-wrapper {    background: #222; width: calc(100% - 20px);margin: 10px; }
        .log-in-wrapper img{width: 100%}
        .log-in-wrapper form input,.log-in-wrapper form select { background: #222;
            border: 0;
            border-radius: 0px;
            border: 1px solid #333; }
    }

    @media screen and (max-width:520px){
        table .form-group label { left: -3px;}
    }

    @media screen and (max-width:425px){
        .log-in-wrapper .submit_button {text-align: center;padding: 20px;margin: 0 auto;    width: 50%;}
        .log-in-wrapper .submit_button input {width: 100px;}
    }
</style>

<body>
<div class="notifications top-right"></div>
<div class="wrapper">
    <div class="page-wrapper">
        <div id="login-hidden" style="display: none;">
            <div class="log-in-wrapper">
                <div class="header">
                    <img src="../img/SpinstatsApplogo.png" alt="SpinStatz Logo"/>
                </div>

                <h1 class="log-in-title">Sign Up<br><small>Create an account to gain access<br>Please move SpinStatz emails to your PRIMARY INBOX to ensure that you receive future emails from us.</small></h1>
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
                <form method="POST" action="{{ route('newlogin') }}" id="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <input type="hidden" class="form-control" name="invitationcode"  data-validetta="required,minLength[7]" value="{{$code }}">
                    </div>


                    <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }} col-lg-6">
                        <input class="form-control input-sm" id="fname" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" data-validetta="required,text">
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                                        <strong>{{ $errors->first('firstname') }}</strong>
                                                    </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }} col-lg-6">
                        <input class="form-control input-sm" id="lname" placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" data-validetta="required,text">
                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                                        <strong>{{ $errors->first('lastname') }}</strong>
                                                    </span>
                        @endif
                    </div>


                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }} col-lg-12">
                        <input class="form-control input-lg" name="phone" id="phone" placeholder="Phone No" value="{{ old('phone') }}" data-validetta="required,text">
                        @if ($errors->has('phone'))
                            <span class="help-block">
                          <strong>Phone number must be numeric</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} col-lg-12">
                        <input id="password" type="password" value="{{ old('password') }}" class="inputBox form-control input-lg" name="password" placeholder="Password" data-validetta="required,regExp[password],minLength[8]" tabindex="0"/>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>Password must be 9 characters one uppercase a number and a symbol</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-lg-12">
                        <input id="password-confirm" value="{{ old('password_confirmation') }}" type="password" class="inputBox form-control input-lg" name="password_confirmation" placeholder="Confirm Password" data-validetta="required,minLength[8],equalTo[password]">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div>
                    </div>
                    <div class="form-group select_group col-lg-12" role="group">
                        <small>Choose DJ Type</small>
                        <select id="btnGroupVerticalDrop" type="button" class="form-control input-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-validetta="required" name="type">
                            <option></option>
                            <option value="normal"  @if(old('type') == 'normal')selected @endif>Club</option>
                            <option value="mobile" @if(old('type') == 'mobile') selected @endif>Mobile</option>
                            <option value="online" @if(old('type') == 'online') selected @endif>Online</option>
                        </select>
                        <div>CLUB DJ: If you DJ EVERY WEEK<br>MOBILE DJ: If you DJ at Weddings, Private Parties, or Special Events.<br>ONLINE DJ: Live Feeds & online broadcasts that have 20 or more concurrent listeners. </small>
                        </div>
                    </div>

                    <div class="form-group select_group col-lg-4" role="group">
                        <select name="country" id="btnGroupVerticalDrop1 " type="button" class="form-control input-lg countryOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-validetta="required">
                        </select>
                        <div><small>Choose Your Country</small>
                        </div>

                    </div>

                    <div class="form-group select_group col-lg-4" role="group">
                        <select name="state" id="btnGroupVerticalDrop1 " type="button" class="form-control input-lg stateOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-validetta="required">
                        </select>
                        <div><small>Choose Your State</small>
                        </div>

                    </div>
                    <div class="form-group select_group {{ $errors->has('city') ? ' has-error' : '' }} col-lg-4">
                        <select name="city" id="btnGroupVerticalDrop1 " type="button" class="form-control input-lg cityOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" data-validetta="required">
                            <option></option>
                        </select>
                        <div class="align-center"><small>Choose Your City</small>
                        </div>

                        @if($errors->has('city'))
                            <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div>
                        <div class="terms-and-condition">
                            <div style="float: left;"><input type="checkbox" class="checkbox"></div>
                            <div ><a href="#" data-toggle="modal" data-target="#myModal">Accept Terms Of Condition</a></div>
                        </div>
                        <div class="footer-design">
                            <div class="submit_button">
                                <input type="submit" value="Sign Up" class="btn btn-transparent btn-lg btn-transparent-primary btn-block signup" disabled>
                            </div>
                            <ul class="login-bottom-links">
                                <li class="btn-block"  style="text-align: center"><a href="/">Already have an account?</a></li>
                            </ul>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Terms Of Condtition</h4>
                </div>
                <div class="modal-body">
                    @include('managertoc')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="../js/Chart.min.js"></script>
<script src="/js/jquery-1.12.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.piety.min.js"></script>
<script src="../js/varello-theme.js"></script>
<script src="../js/icheck.min.js"></script>
<script src="../js/dropdown.js"></script>
<script src="{{asset('js/validetta.js')}}"></script>
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
</body>
</html>
@extends('messenger')

<script>
    $(".checkbox").change(function() {
        if(this.checked) {
            //Do stuff
            //console.log("checked")
            $('.signup').prop('disabled', false);
        }else{
            console.log("unchecked")
            $('.signup').prop('disabled', true);
        }
    });

    $('#email').change(function () {
        var email = $('#email').val();
        checkEmail(email);
    });

    function checkEmail(email) {
        $.get('/checkemail/' + email, function (data) {
            console.log(data)
            if (data>0){
                $('#email').after('<span class="validetta-bubble validetta-bubble--right" style="top: 355.6px; left: 837.5px;">This email is already taken.<br></span>');
            }
        });
    }


    $(document).ready(function(){

        var country_selected = '{{ old('country') }}';
        var state_selected = '{{ old('state') }}';
        var city_selected = '{{ old('city') }}';

        $.get( "/countries", function( data ) {
            $('.countryOption').append('<option></option>');
            $('.countryOption').append('<option value="231"> United States</option>');
            value = $('.countryOption').attr("val");
            $.each(data,function(index,stateObject){
                if(value == stateObject.id){
                    appende = '<option  value="'+stateObject.id+'" selected>'+stateObject.name + '</option>';
                }
                else{
                    appende = '<option  value="'+stateObject.id+'">'+stateObject.name + '</option>';
                }
                $('.countryOption').append(appende);
            });

            country = $( ".countryOption" ).val();
            loadState(country);

            if(country_selected!=""){
                $('.countryOption option[value='+ parseInt(country_selected) +']').prop('selected',true);
                $('.countryOption').trigger('change');
            }

        });

        $('.countryOption').change(function(element){
            $('.stateOption').html('');
            $('.cityOption').html('');
            loadState(this.value);

            if(state_selected!=""){
                //alert('.stateOption option[value='+ parseInt(state_selected) +']');
                setTimeout(function(){
                    $('.stateOption option[value='+ parseInt(state_selected) +']').prop('selected',true);
                    $('.stateOption').trigger('change');
                },1000);
            }

        })

        $('.stateOption').change(function(element){
            $('.cityOption').html('');
            loadCity(this.value);

            if(city_selected!=""){
                //alert('.cityOption option[value='+ parseInt(city_selected) +']');
                setTimeout(function(){
                    $('.cityOption option[value='+ parseInt(city_selected) +']').prop('selected',true);
                    $('.cityOption').trigger('change');
                },1000);
            }

        })

    });

    function loadState(country){
        $.get( "/country/states/"+country, function( data ) {
            $('.stateOption').append('<option></option>');
            value = $('.stateOption').attr("val");
            $.each(data,function(index,stateObject){
                //console.log(value,stateObject.id)
                if(value == stateObject.id){
                    $('.stateOption').append('<option  value="'+stateObject.id+'" selected>'+ stateObject.name + '</option>');
                }else{
                    $('.stateOption').append('<option  value="'+stateObject.id+'">'+ stateObject.name + '</option>');
                }
            });

            state = $( ".stateOption" ).val();
            loadCity(state)
        })
    }


    function loadCity(state){
        $.get( "/state/cities/"+state, function( data ) {
            //$('.cityOption').
            value = $('.cityOption').attr("val");
            $('.cityOption').append('<option></option>');
            $.each(data,function(index,stateObject){
                if(value == stateObject.id){
                    $('.cityOption').append('<option  value="'+stateObject.id+'"selected>'+stateObject.name + '</option>');
                }else{
                    $('.cityOption').append('<option  value="'+stateObject.id+'">'+stateObject.name + '</option>');
                }
            });
            //loadData()
        });
    }

</script>
