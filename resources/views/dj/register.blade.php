<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SpinStatz | Register</title>
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
    <link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ URL::asset('css/material.css')}}">

    <style>
        .mdl-layout__container {
            background: #151515;
        }

        .mdl-textfield__label:after {
            display: none !important;
        }

        .dropdown-design select {
            height: 35px;
            width: 100%;
            background: transparent;
            color: #616161;
            border: 0;
            border-bottom: 1px solid #616161;
            padding: 0 !important;
            font-size: 15px;
            font-family: "Helvetica", "Arial", sans-serif;
        }

        .dropdown-design select:focus {
            outline: 0 !important;
            border: 0 !important;
            border-bottom: 1px solid #616161 !important;
            box-shadow: none !important;
			background-color: #111111;
        }

        span.mdl-checkbox__box-outline {
            border-color: transparent;
        }

        .checkbox-terms {
            transform: scale(1.5);
            margin-right: 10px;
        }

        div#boostrap-modal-terms-and-condition .modal-footer {
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .terms-and-condition-popup input {
            display: inline !important;
        }

        div#boostrap-modal-terms-and-condition .modal-footer .btn {
            cursor: pointer;
            background: #000;
            border: 0;
            color: #fff;
            padding: 10px 30px;
        }

        input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus, input:-webkit-autofill:active {
            transition: background-color 5000s;
            -webkit-text-fill-color: #fff !important;
        }

        .dropdown-design select {
            color: #fff;
        }

        .dropdown-design select option {
            color: #616161;
        }

        a.open-terms-popup {
            color: #78FFFF !important;
        }

        span#email-error ~ label {
            top: 0;
        }

        span#email_confirmation-error ~ label {
            top: 0;
        }

        /* 18-07-2018 */
        .header img {
            max-width: 200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
        }

        .log-in-wrapper img {
            margin-top: 0px;
            background: #111;
            width: 100%
        }

        .log-in-wrapper .validetta-bubble {
            padding: 5px 12px;
            font-style: italic;
        }

        .log-in-wrapper h1 {
            padding: 20px;
            text-align: center;
            margin-bottom: -20px
        }

        .log-in-wrapper h1 small {
            color: #FFF !important;
        }

        .log-in-wrapper form select option {
            color: #fff;
        }

        .log-in-wrapper select {
            -moz-appearance: none; /* for Chrome */
            -webkit-appearance: none;
            text-align: left;
            position: relative;
        }

        .log-in-wrapper .select_group {
            position: relative;
        }

        .log-in-wrapper .select_group::after {
            content: "\f107";
            font-family: FontAwesome;
            color: #bfbfbf;
            position: absolute;
            right: 1px;
            top: 1px;
            z-index: 1;
            text-align: center;
            width: 25px;
            pointer-events: none;
            box-sizing: border-box;
            height: 32px;
            line-height: 38px;
            text-align: center;
            padding-left: 2px;
        }

        .mdl-textfield__input {
            border-bottom: 1px solid #616161 !important;
        }

        #form input:focus ~ label {
            top: 0;
        }

        #form input:focus, #form select:focus {
            outline: none !important;
        }

        .mdl-textfield, .mdl-textfield label {
            color: #fff !important;
        }

        .log-in-wrapper {
            width: 100%;
            max-width: 800px;
            padding: 0px;
        }

        .log-in-wrapper .submit_button {
            text-align: center;
            padding: 20px;
            margin: 0 auto;
        }

        .log-in-wrapper .submit_button input {
            width: 200px;
            margin: 0 auto;
        }

        .log-in-wrapper .submit_button input {
            background: #000;
            border: 0;
        }

        .form-control, select {
            height: 40px !important;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        #form {
            padding: 20px;
            padding-bottom: 0px;
        }

        table {
            margin-top: 15px;
        }

        table .form-group {
            margin-bottom: 0px;
        }

        table .form-group label {
            left: -39px;
            top: 3px;
        }

        .terms-and-condition {
            margin-top: 20px;
        }

        .terms-and-condition input {
            margin-right: 10px;
        }

        .footer-design {
            background: #40484b;
            margin-top: 0px;
            margin-top: 17px;
        }

        .terms-and-condition a {
            color: #78FFFF !important;
            font-weight: bold;
            text-decoration: underline;
            font-size: 16px;
        }

        .login-bottom-links {
            margin: 0;
            margin-top: 0px;
            padding: 0;
            padding-right: 0px;
            text-align: right;
            padding-right: 14px;
            margin-top: -20px;
        }

        .log-in-wrapper .submit_button input {
        }

        .icheck-label {
            font-size: 14.5px !important;
        }

        .terms-and-condition {
            margin-top: 20px;
            border-top: 1px solid #40484b;
            padding-top: 12px;
        }

        form .validetta-bubble {
            background: transparent !important;
            color: #cd2e26 !important;
            left: -12px !important;
            top: 50px !important;
            max-width: 100%;
            font-weight: bold;
        }

        .validetta-bubble--right:before {
            display: none !important;
        }

        @media screen and (max-width: 990px) {
            .log-in-wrapper .validetta-bubble {
                min-width: auto;
                padding: 3px 7px;
                position: static;
                width: 100%;
                max-width: none;
                border-radius: 0;
                font-style: italic;
            }

            .log-in-wrapper .validetta-bubble::before {
                border-style: none;
            }

            .log-in-wrapper img {
                margin-top: 0px;
                background: #111;
                width: 100%
            }

        }

        @media screen and (max-width: 768px) {
            .log-in-wrapper {
                background: #222;
                width: calc(100% - 20px);
                margin: 10px;
            }

            .log-in-wrapper img {
                width: 100%
            }


        }

        @media screen and (max-width: 520px) {
            table .form-group label {
                left: -3px;
            }
        }

        @media screen and (max-width: 425px) {
            .log-in-wrapper .submit_button {
                text-align: center;
                padding: 20px;
                margin: 0 auto;
                width: 50%;
            }

            .log-in-wrapper .submit_button input {
                width: 100px;
            }
        }
    </style>
</head>
<body>
<div class="notifications top-right"></div>
<div class="wrapper mdl-layout mdl-js-layout">
    <div class="pagewrapper">
        <div id="login-hidden" style="display: none;">
            <div class="log-in-wrapper">
                <div class="header">
                    <img src="../img/SpinstatsApplogo.png" alt="SpinStatz Logo"/>
                </div>

                <h1 class="log-in-title">Sign Up<br><small>Create an account to gain access<br>Please move SpinStatz
                        emails to your PRIMARY INBOX to ensure that you receive future emails from us.</small></h1>

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
                <form method="POST" action="{{ route('djregister') }}" id="form">
                    {{ csrf_field() }}

                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" type="text" name="invitationcode"
                                       data-validetta="required,minLength[7]" value="{{$code }}">
                                <label class="mdl-textfield__label" for="campaign-name"><span
                                            class="fa fa-lock list-group-item-icon"></span> Please enter
                                    your DJ Invite Code.</label>
                                @if ($errors->has('invitationcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invitationcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
{{--                        <div class="mdl-cell mdl-cell--12-col">--}}
{{--                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"--}}
{{--                                 style="width: 100%;">--}}
{{--                                <input type="hidden" value="" id="hiddenemail" name="hiddenemail" id="hiddenemail"--}}
{{--                                       class="inputBox"/>--}}
{{--                                <input class="mdl-textfield__input" type="email" name="email" id="email"--}}
{{--                                       value="{{ $email }}"--}}
{{--                                       data-validetta="required,email,different[hiddenemail]"--}}
{{--                                       data-vd-message-different="That email is already taken.">--}}
{{--                                <label class="mdl-textfield__label" for="email">Your Email Address</label>--}}
{{--                                @if ($errors->has('email'))--}}
{{--                                    <span class="help-block">--}}
{{--                                    <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                </span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        {{--                    <div class="form-group {{ $errors->has('email_confirmation') ? ' has-error' : '' }}">--}}
                        {{--                      <input class="form-control input-lg inputBox" name="email_confirmation" id="email_confirmation" placeholder="Confirm Email" value="{{ old('email_confirmation') }}" data-validetta="required,equalTo[email]]">--}}
                        {{--                    </div>--}}
                        {{--                        @if ($errors->has('email_confirmation'))--}}
                        {{--                            <span class="help-block">--}}
                        {{--                                <strong>{{ $errors->first('email_confirmation') }}</strong>--}}
                        {{--                            </span>--}}
                        {{--                        @endif--}}
                        {{--                        --}}

                        {{--                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">--}}
                        {{--                            <input type="text" class="form-control input-lg" name="username" id="username"--}}
                        {{--                                   placeholder="Username" name="username" value="{{ old('username') }}"--}}
                        {{--                                   data-validetta="required,text">--}}
                        {{--                            @if ($errors->has('username'))--}}
                        {{--                                <span class="help-block">--}}
                        {{--                                                    <strong>{{ $errors->first('username') }}</strong>--}}
                        {{--                                                </span>--}}
                        {{--                            @endif--}}
                        {{--                        </div>--}}

                        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" type="text" id="fname" name="firstname"
                                       value="{{ old('firstname') }}" data-validetta="required,text">
                                <label class="mdl-textfield__label" for="fname">First Name</label>
                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('firstname') }}</strong>
                                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" type="text" name="lastname"
                                       value="{{ old('lastname') }}" data-validetta="required,text">
                                <label class="mdl-textfield__label" for="lastname">Last Name</label>
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('lastname') }}</strong>
                                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" type="text" name="djname" id="djname"
                                       value="{{ old('djname') }}" data-validetta="required,text">
                                <label class="mdl-textfield__label" for="djname">Dj Name</label>
                                @if ($errors->has('djname'))
                                    <span class="help-block">
                          <strong>{{ $errors->first('djname') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" type="text" name="phone" id="phone"
                                       value="{{ old('phone') }}" data-validetta="required,text">
                                <label class="mdl-textfield__label" for="phone">Phone No</label>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                          <strong>Phone number must be numeric</strong>
                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" type="password" value="{{ old('password') }}"
                                       name="password" id="password"
                                       data-validetta="required,regExp[password],minLength[8]" tabindex="0"/>
                                <label class="mdl-textfield__label" for="password">Password</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>Password must be 9 characters one uppercase a number and a symbol</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                 style="width: 100%;">
                                <input class="mdl-textfield__input" id="password-confirm"
                                       value="{{ old('password_confirmation') }}" type="password"
                                       name="password_confirmation"
                                       data-validetta="required,minLength[8],equalTo[password]">
                                <label class="mdl-textfield__label" for="password-confirm">Confirm Password</label>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="type" value="normal">

<!--                        <div class="select_group mdl-cell mdl-cell--12-col dropdown-design">-->
<!--                            <select id="btnGroupVerticalDrop" type="button" class="form-control input-lg"-->
<!--                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"-->
<!--                                    data-validetta="required" name="type">-->
<!--                                <option>Choose DJ Type</option>-->
<!--                                <option value="normal" @if(old('type') == 'normal')selected @endif>Normal DJ</option>-->
                               <!-- <option value="mobile" @if(old('type') == 'mobile') selected @endif>Mobile</option> -->
<!--                                <option value="online" @if(old('type') == 'online') selected @endif>Online DJ</option>-->
<!--                            </select>-->
<!--                            <div>NORMAL DJ: If you DJ at Clubs, Weddings, Private Parties, Restaurants, Bars, or-->
<!--                                Special Events<br> -->
                                <!--MOBILE DJ: .<br> -->
<!--                                ONLINE DJ: Live Feeds & online broadcasts that have 20 or more-->
<!--                                concurrent listeners.-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="select_group mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet dropdown-design">
                            <select name="country" id="btnGroupVerticalDrop1 " type="button"
                                    class="form-control input-lg countryOption" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false" data-validetta="required">
                                <option>Select your Country</option>
                            </select>
                        </div>

                        {{--                      <div class="form-group {{ $errors->has('software') ? ' has-error' : '' }}">--}}
                        {{--                        <input class="form-control input-lg" name="software" id="software" placeholder="DJ Software" value="{{ old('software') }}" data-validetta="required,text">--}}
                        {{--                        @if ($errors->has('software'))--}}
                        {{--                        <span class="help-block">--}}
                        {{--                          <strong>{{ $errors->first('software') }}</strong>--}}
                        {{--                        </span>--}}
                        {{--                        @endif--}}
                        {{--                      </div>--}}


                        <div class="select_group mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet dropdown-design">
                            <select name="state" id="btnGroupVerticalDrop1 " type="button"
                                    class="form-control input-lg stateOption" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false" data-validetta="required">
                                <option>Choose your state</option>
                            </select>
                        </div>

                        <div class="select_group mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet dropdown-design">
                            <select name="city" id="btnGroupVerticalDrop1 " type="button"
                                    class="form-control input-lg cityOption" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" name="city" data-validetta="required">
                                <option>Choose Your City</option>
                            </select>
                            @if($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mdl-cell mdl-cell--12-col">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>

                                <tr>
                                    <td colspan="5"><p class="help-block">Type of Music you Spin (Select up to 6 genres.
                                            If
                                            more are needed send email to djs@spinstatz.com)</p></td>
                                </tr>
                                @for($i=0; $i < count($musicTypes)/2; $i++)
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" name="musictype[]" data-icheck
                                                       value="{{$musicTypes[$i*2]->id}}"
                                                       @if(in_array($musicTypes[$i*2]->id,(array) old('musictype')))checked @endif
                                                >
                                                <label for="terms_and_conditions" class="icheck-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="terms_and_conditions"
                                                       class="icheck-label">{{$musicTypes[$i*2]->name}}</label>
                                            </div>
                                        </td>
                                        @if(count($musicTypes) <= $i*2+1)
                                            @break
                                        @endif
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" name="musictype[]"
                                                       data-icheck value="{{$musicTypes[$i*2+1]->id}}"
                                                       @if(in_array($musicTypes[$i*2+1]->id,(array) old('musictype')))checked @endif
                                                >
                                                <label for="terms_and_conditions" class="icheck-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="terms_and_conditions" class="icheck-label">

                                                    {{$musicTypes[$i*2+1]->name}}

                                                </label>
                                            </div>
                                        </td>


                                    </tr>
                                @endfor

                                </tbody>
                            </table>


                            <div class="terms-and-condition terms-and-condition-popup">
                                <div class="text-center">
                                    <span class="text-left"><input type="checkbox" class="checkbox"></span><a href="#"
                                                                                                              data-toggle="modal"
                                                                                                              data-target="#myModal">Accept
                                        Terms Of
                                        Condition</a>
                                </div>
                            </div>
                            <div class="footer-design">
                                <div class="submit_button">
                                    <input type="submit" value="Sign Up"
                                           class="btn btn-transparent btn-lg btn-transparent-primary btn-block signup"
                                           disabled>
                                </div>
                                <ul class="login-bottom-links">
                                    <li><a href="/">Already have an account?</a></li>
                                </ul>
                            </div>
                        </div>
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
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="../js/Chart.min.js"></script>
<script src="/js/jquery-1.12.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.piety.min.js"></script>
<script src="../js/dropdown.js"></script>
<script src="{{asset('js/validetta.js')}}"></script>
<script src="../js/icheck.min.js"></script>
<script src="../js/varello-theme.js"></script>
<script src="{{ URL::asset('js/material.js') }}"></script>

@extends('messenger')

<script>
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

    $(".checkbox").change(function () {
        if (this.checked) {
            //Do stuff
            //console.log("checked")
            $('.signup').prop('disabled', false);
        } else {
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
            if (data > 0) {
                $('#email').after('<span class="validetta-bubble validetta-bubble--right" style="top: 355.6px; left: 837.5px;">This email is already taken.<br></span>');
            }
        });
    }


    $(document).ready(function () {

        var country_selected = '{{ old('country') }}';
        var state_selected = '{{ old('state') }}';
        var city_selected = '{{ old('city') }}';

        $.get("/countries", function (data) {
            $('.countryOption').append('<option></option>');
            $('.countryOption').append('<option value="231"> United States</option>');
            value = $('.countryOption').attr("val");
            $.each(data, function (index, stateObject) {
                if (value == stateObject.id) {
                    appende = '<option  value="' + stateObject.id + '" selected>' + stateObject.name + '</option>';
                } else {
                    appende = '<option  value="' + stateObject.id + '">' + stateObject.name + '</option>';
                }
                $('.countryOption').append(appende);
            });

            country = $(".countryOption").val();
            loadState(country);

            if (country_selected != "") {
                $('.countryOption option[value=' + parseInt(country_selected) + ']').prop('selected', true);
                $('.countryOption').trigger('change');
            }

        });

        $('.countryOption').change(function (element) {
            $('.stateOption').html('');
            $('.cityOption').html('');
            loadState(this.value);

            if (state_selected != "") {
                //alert('.stateOption option[value='+ parseInt(state_selected) +']');
                setTimeout(function () {
                    $('.stateOption option[value=' + parseInt(state_selected) + ']').prop('selected', true);
                    $('.stateOption').trigger('change');
                }, 1000);
            }

        })

        $('.stateOption').change(function (element) {
            $('.cityOption').html('');
            loadCity(this.value);

            if (city_selected != "") {
                //alert('.cityOption option[value='+ parseInt(city_selected) +']');
                setTimeout(function () {
                    $('.cityOption option[value=' + parseInt(city_selected) + ']').prop('selected', true);
                    $('.cityOption').trigger('change');
                }, 1000);
            }

        })

    });

    function loadState(country) {
        $.get("/country/states/" + country, function (data) {
            $('.stateOption').append('<option></option>');
            value = $('.stateOption').attr("val");
            $.each(data, function (index, stateObject) {
                //console.log(value,stateObject.id)
                if (value == stateObject.id) {
                    $('.stateOption').append('<option  value="' + stateObject.id + '" selected>' + stateObject.name + '</option>');
                } else {
                    $('.stateOption').append('<option  value="' + stateObject.id + '">' + stateObject.name + '</option>');
                }
            });

            state = $(".stateOption").val();
            loadCity(state)
        })
    }


    function loadCity(state) {
        $.get("/state/cities/" + state, function (data) {
            //$('.cityOption').
            value = $('.cityOption').attr("val");
            $('.cityOption').append('<option></option>');
            $.each(data, function (index, stateObject) {
                if (value == stateObject.id) {
                    $('.cityOption').append('<option  value="' + stateObject.id + '"selected>' + stateObject.name + '</option>');
                } else {
                    $('.cityOption').append('<option  value="' + stateObject.id + '">' + stateObject.name + '</option>');
                }
            });
            //loadData()
        });
    }

</script>
</body>
</html>