<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Spinstatz | Sign Up</title>

    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{ URL::asset('images/android-desktop.png')}}">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('images/ios-desktop.png')}}">

    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.html">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png')}}">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ URL::asset('css/material.css')}}">
    <link href="{{ URL::asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/select2.material.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/spinstatz.css')}}">
    <style type="text/css">
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
        }
    </style>
    <style type="text/css">
        div#boostrap-modal-terms-and-condition {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
            overflow: scroll;
            display: none;
        }

        div#boostrap-modal-terms-and-condition .modal-dialog {
            position: absolute;
            width: 70%;
            min-width: 300px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            background: #fff; /* overflow-y: scroll; */
            margin-top: 20px;
            margin-bottom: 50px;
            padding: 20px;
            border-radius: 4px;
        }

        div#boostrap-modal-terms-and-condition button.close {
            position: absolute;
            right: 20px;
            margin-top: -10px;
            background: #000;
            color: #fff;
            border-radius: 100%;
            font-size: 20px;
            border: 0;
            cursor: pointer;
        }

        /*div#boostrap-modal-terms-and-condition .modal-footer{ display: none; }*/
        div#boostrap-modal-terms-and-condition h4.modal-title {
            margin-top: 5px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        div#boostrap-modal-terms-and-condition p {
            line-height: 20px;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
<div class="mdl-layout mdl-js-layout">
    <main class="mdl-layout__content mdl-color--grey-800 mdl-color-text--grey-50" style="padding-bottom: 50px;">
        <div class="signup-background">
            <header id="sign-up-header" class="mdl-layout__header mdl-layout__header--transparent">
                <div class="mdl-layout__header-row" style="flex-direction: column;">
                    <div class="drawer-logo-container" style="padding: 0;">
                        <a href="#"><img class="drawer-logo"
                                         src="{{ URL::asset('https://spinstatz.com/wp-content/uploads/2020/03/loginlogo.png')}}"
                                         style="max-width: 250px;"></a>
                    </div>
                </div>
            </header>
            <div class="content" style="margin-top: 120px;">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col mdl-cell--hide-tablet">
                    </div>
                    @if($package == "starter")
                        <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet">
                            <div class="mdl-card mdl-shadow--2dp mdl-color--black pricing-card">
                                <div class="mdl-card__title mdl-color-text--grey-50">
                                    <h2 class="mdl-card__title-text">Starter</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <h3 class="no-margin mdl-color-text--grey-50 bold-accent-text"
                                        style="text-align: center;">$100</h3>
                                    <h6 class="mdl-color-text--grey-50" style="text-align: center;line-height: 18px;">
                                        DOWNLOADABLE VIDEOS OF DJS PLAYING YOUR MUSIC</h6>
                                    <ul class="mdl-list">
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Fixed spinrate
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span id="video-clips-1"
                                                  class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            <span style="border-bottom: 1px dashed #747474; padding-bottom: 2px;">Video Clips</span>
                                            </span>
                                            <div class="mdl-tooltip" data-mdl-for="video-clips-1">
                                                Downloadable video clips of DJs playing your music
                                            </div>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Team of DJs
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Direct communication with DJs
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Prime Time placement
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Personal Dashboard
                                        </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Detailed Stats
                                        </span>
                                        </li>
                                    </ul>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    @elseif($package == "standard")
                        <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet">
                            <div class="mdl-card mdl-shadow--2dp mdl-color--black pricing-card">
                                <div class="mdl-card__title mdl-color-text--grey-50">
                                    <h2 class="mdl-card__title-text">Standard</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <h3 class="no-margin mdl-color-text--grey-50 bold-accent-text"
                                        style="text-align: center;">$250</h3>
                                    <h6 class="mdl-color-text--grey-50" style="text-align: center;line-height: 18px;">
                                        CUSTOMIZE THE AMOUNT OF CLUB SPINS</h6>
                                    <ul class="mdl-list">
                                        <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Adjustable spinrate ($5-$50/Spin)
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span id="video-clips-2"
                                                  class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            <span style="border-bottom: 1px dashed #747474; padding-bottom: 2px;">Video Clips</span>
                                            </span>
                                            <div class="mdl-tooltip" data-mdl-for="video-clips-2">
                                                Downloadable video clips of DJs playing your music
                                            </div>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span id="ads"
                                                  class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            <span style="border-bottom: 1px dashed #747474; padding-bottom: 2px;">Advertisement</span>
                                            </span>
                                            <div class="mdl-tooltip" data-mdl-for="ads">
                                                Ability to advertise your music to our club DJ network
                                            </div>
                                        </li>
                                        <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Direct communication with DJs
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Prime Time placement
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Personal Dashboard
                                        </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Detailed Stats
                                        </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Great support
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet">
                            <div class="mdl-card mdl-shadow--2dp mdl-color--black pricing-card">
                                <div class="mdl-card__title mdl-color-text--grey-50">
                                    <h2 class="mdl-card__title-text">Career Boost</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <h3 class="no-margin mdl-color-text--grey-50 bold-accent-text"
                                        style="text-align: center;">$2000</h3>
                                    <h6 class="mdl-color-text--grey-50" style="text-align: center;line-height: 18px;">CUSTOMIZE THE AMOUNT
                                        OF CLUB SPINS</h6>
                                    <ul class="mdl-list">
                                        <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Adjustable spinrate ($5-$50/Spin)
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span id="video-clips-2"
                                                  class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            <span style="border-bottom: 1px dashed #747474; padding-bottom: 2px;">Video Clips</span>
                                            </span>
                                            <div class="mdl-tooltip" data-mdl-for="video-clips-2">
                                                Downloadable video clips of DJs playing your music
                                            </div>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span id="ads"
                                                  class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            <span style="border-bottom: 1px dashed #747474; padding-bottom: 2px;">Advertisement</span>
                                            </span>
                                            <div class="mdl-tooltip" data-mdl-for="ads">
                                                Ability to advertise your music to our club DJ network
                                            </div>
                                        </li>
                                        <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Direct communication with DJs
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                        <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Prime Time placement
                                            </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Personal Dashboard
                                        </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Detailed Stats
                                        </span>
                                        </li>
                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content mdl-color-text--grey-50">
                                            <i class="material-icons mdl-list__item-icon mdl-color-text--grey-50">done</i>
                                            Great support
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="mdl-cell mdl-cell--4-col mdl-cell--hide-tablet">
                    </div>
                </div>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->getMessages() as $key => $error)
                        @if($key!='email' && $key!='username' && $key!='password' )
                            <li>{{$key}} {{ $error[0] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="content" style="margin-top: 50px;">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet">
                </div>
                <div class="mdl-cell mdl-cell--8-col mdl-cell--12-col-tablet">
                    <h3 style="text-align: center;">Create your artist campaign</h3>
                    <form action="{{ url('/user/campaign/store') }}" method="post" class="registerFrm"
                          autocomplete="off">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="referid" value="{{$referid}}">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="text" id="campaign_name"
                                           name='campaignname' required="" value="{{ old('campaignname') }}">
                                    <label class="mdl-textfield__label" for="campaign-name">Campaign Name</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="text" id="first_name" name='fname'
                                           required="" value="{{ old('fname') }}">
                                    <label class="mdl-textfield__label" for="first-name">First Name</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="text" id="last_name" name='lname'
                                           required="" value="{{ old('lname') }}">
                                    <label class="mdl-textfield__label" for="last-name">Last Name</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="email" id="email" name='email'
                                           autocomplete="off" required="" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <span id="email-error" class="error">{{ $errors->first('email') }}</span>
                                    @endif
                                    <label class="mdl-textfield__label" for="email">E-Mail</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="email" id="email_confirmation"
                                           name='email_confirmation' required=""
                                           value="{{ old('email_confirmation') }}">

                                    <label class="mdl-textfield__label" for="confirm-email">Confirm E-Mail</label>
                                </div>
                            </div>
                        <!--  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet" style="display: none;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%;">
                                    <input class="mdl-textfield__input" type="text" id="user_name" name='username' value="{{ old('email') }}">
                                    <label class="mdl-textfield__label" for="username">Username</label>
                                </div>
                            </div> -->
                            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" autocomplete="new-password" type="password"
                                           id="password" name='password' required="" value="{{ old('password') }}">
                                    @if($errors->has('password'))
                                        <span id="password-error" class="error">{{ $errors->first('password') }}</span>
                                    @endif
                                    <label class="mdl-textfield__label" for="password">Password</label>
                                </div>
                            </div>


                            <!-- <div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet" data-select2-id="5">
                                    <select id="country-select" data-select2-id="country-select" tabindex="-1" class="countryOption select2-hidden-accessible" aria-hidden="true">
                                        <option data-select2-id="2"></option>
                                    </select>
                            </div>

                            <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%;">
                                    <select id="btnGroupVerticalDrop1 " name="state"   type="button" class="btn btn-default dropdown-toggle stateOption form-control"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="stateOption" data-validetta="required"></select>

                                    <label class="mdl-textfield__label" for="state">State</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%;">
                                    <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle cityOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" id="cityOption" data-validetta="required">

                                    </select>
                                    <label class="mdl-textfield__label" for="city">City2222</label>
                                </div>
                            </div> -->


                            <div class="select_group mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet dropdown-design">
                                <select id="country" name="country" type="button" class="countryOption form-control"
                                        required="">
                                    <option value="" disabled selected>Select your Country</option>
                                </select>
                            </div>
                            <div class="select_group mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet dropdown-design">
                                <select id="state" name="state" type="button"
                                        class="btn btn-transparent dropdown-toggle stateOption form-control"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        id="stateOption" required="">
                                    <option value="" disabled selected>Select your State</option>
                                </select>
                            </div>
                            <div class="select_group mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet dropdown-design">
                                <select id="city" type="button"
                                        class="btn btn-default dropdown-toggle cityOption form-control"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city"
                                        id="cityOption" required="">
                                    <option value="" disabled selected>Select your City</option>
                                </select>
                            </div>


                            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="number" id="mobile" name='phone'
                                           required="" value="{{ old('phone') }}">
                                    <label class="mdl-textfield__label" for="phone">Mobile Number</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="text" id="street_address" name='street'
                                           required="" value="{{ old('street') }}">
                                    <label class="mdl-textfield__label" for="street">Street Address</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                                     style="width: 100%;">
                                    <input class="mdl-textfield__input" type="number" id="zip_code" name='zipcode'
                                           required="" value="{{ old('zipcode') }}">
                                    <label class="mdl-textfield__label" for="zip">ZIP Code</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col" style="margin-top: 25px; text-align: center;">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2"
                                       style="width: auto; MARGIN-BOTTOM: 20PX;">
                                    <input type="checkbox" id="checkbox-2" name="checkbox-terms" class="checkbox-terms">
                                    <span class="mdl-checkbox__label"><a for="checkbox-2" href="#"
                                                                         class="open-terms-popup" data-toggle="modal"
                                                                         data-target="#myModal">I accept the Terms of Use and Privacy Policy</a></span>
                                </label><br>
                                <button type="submit" id="isSubmitButtonClicked"
                                        class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--black mdl-color--cyan-A100 mdl-border-button-accent"
                                        style="margin-top: 25px;">
                                    Create campaign
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet">
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Terms Popup -->
<div id="boostrap-modal-terms-and-condition" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
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

<script src="{{ URL::asset('js/material.js') }}"></script>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/select2.min.js') }}"></script>
<script src="{{ URL::asset('js/dashboard.signup.js') }}"></script>
<script src="{{ URL::asset('js/locationchooser.js') }}?v=5"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        /* Terms check to enabled sign up */

        $(document).on('click', 'div#boostrap-modal-terms-and-condition button.close,div#boostrap-modal-terms-and-condition .modal-footer .btn', function (e) {
            e.preventDefault();
            $('div#boostrap-modal-terms-and-condition').hide();
        });

        $(document).on('click', '.open-terms-popup', function (e) {
            e.preventDefault();
            $('.checkbox-terms').prop('checked', 'checked');
            $('div#boostrap-modal-terms-and-condition').show();
        });

    });
</script>
<style type="text/css">
    span.error {
        color: #db0606;
        font-size: 13px;
        font-style: italic;
        margin-top: 3px;
        display: block;
    }

    .registerFrm input:focus, .registerFrm select:focus {
        outline: none !important;
    }

    .registerFrm input:valid ~ label {
        top: 0;
    }

    .registerFrm input:focus ~ label {
        top: 0;
    }
</style>
<script type="text/javascript">
    jQuery(function ($) {
        jQuery(document).ready(function ($) {

            // $(document).find('#email').on('keyup change',function(){
            //     $(document).find('#user_name').val($(this).val());
            // });

            $(".registerFrm").validate({
                errorElement: 'span',
                rules: {
                    campaign_name: "required",
                    first_name: "required",
                    last_name: "required",
                    password: {
                        "required": true,
                        minlength: 6
                    },
                    country: "required",
                    state: "required",
                    city: "required",
                    street_address: "required",
                    'checkbox-terms': 'required',
                    zip_code: "required",
                    mobile: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    email_confirmation: {
                        required: true,
                        email: true,
                        equalTo: '#email'
                    }
                },
                messages: {
                    campaign_name: "Please enter compaign name.",
                    first_name: "Please enter first name.",
                    last_name: "Please enter last name.",
                    password: {
                        "required": "Please enter password.",
                        minlength: "Password must be at least 6 digits long."
                    },
                    country: "Please select country.",
                    state: "Please select state.",
                    city: "Please select city.",
                    street_address: "Please enter street address.",
                    zip_code: "Please enter zip code.",
                    mobile: {
                        required: "Please enter mobile no.",
                        number: "Mobile must be numeric."
                    },
                    email: {
                        required: "Please enter email.",
                        email: "Please enter valid email."
                    },
                    email_confirmation: {
                        required: "Please enter email.",
                        email: "Please enter valid email.",
                        equalTo: 'Confirm email must be same as email.'
                    },
                    'checkbox-terms': 'Please accept Terms & Condition.'
                }
            });


            $(document).ajaxComplete(function (event, xhr, settings) {
                if (settings.url == '/countries') {
                    $(document).find("select[name=country] option[value='{{ old('country') }}']").prop('selected', true);
                    $(document).find("select[name=country]").trigger('change');
                }
                console.log(settings.url);
                if (settings.url.includes('/country/states/')) {
                    $(document).find("select[name=state] option[value='{{ old('state') }}']").prop('selected', true);
                    $(document).find("select[name=state]").trigger('change');
                }
                if (settings.url.includes('/state/cities/')) {
                    $(document).find("select[name=city] option[value='{{ old('city') }}']").prop('selected', true);
                }
            });

        });
    });
</script>
<style type="text/css">
    span#checkbox-terms-error {
        position: absolute;
    }
</style>

</body>
</html>
