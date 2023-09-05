@extends('layouts.djmanager') 
@section('content')
<title>SpinStatz | Edit Profile</title>
<link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>
    <header class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header-heading"><span class="typcn typcn-user-add page-header-heading-icon"></span>
                        Update Profile</h1>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data" id="form">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Information
                        </div>
                        <div class="panel-body">
                            <p>The basic required account information</p>
                            <div class="form-group margin-top-15">
                                <label class="col-sm-2 col-xs-12 control-label">First Name</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$djmanager->first_name}}" name="first_name" data-validetta="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Last Name</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$djmanager->last_name}}" name="last_name">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Email Address</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="email" class="form-control" value="{{$currentUser->email}}" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$djmanager->phone_no}}" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Location
                        </div>
                        <div class="panel-body">

                            <div class="form-group" role="group">
                                <label class="col-sm-2 col-xs-12 control-label">Country</label>
                                <div class="col-sm-10 col-xs-12">
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle countryOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$country->id}}" data-validetta="required">

                                  </select>
                                </div>
                                @if($errors->has('country'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                                @endif
                            </div>

                                <div class="form-group" role="group">
                                    <label class="col-sm-2 col-xs-12 control-label">State</label>
                                <div class="col-sm-10 col-xs-12">
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle stateOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$state->id}}" data-validetta="required">
                                  </select>
                                </div>
                                @if($errors->has('state'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                                @endif
                            </div>

                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label class="col-sm-2 col-xs-12 control-label">City</label>
                                <div class="col-sm-10 col-xs-12">
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle cityOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" val="{{$city->id}}" data-validetta="required">
                                  </select>
                                </div>
                                @if($errors->has('city'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label class="col-sm-2 col-xs-12 control-label">Zipcode</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$djmanager->zipcode}}" name="zipcode">
                                     @if($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">
                        Payment Information
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-xs-12 control-label">Paypal Email</label>
                        <div class="col-sm-10 col-xs-12">
                            <input type="text" class="form-control">
                            <p class="help-block">Please enter the PayPal email where you would like to transfer your
                                earned
                                funds.<br> <a href="#" class="btn btn-faded-blue">Link PayPal Account</a></p>
                        </div>
                    </div>


                    <div class="panel">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">New Password</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Confirm New Password</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="password" class="form-control" name="password_confirm">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Logo</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="file" class="form-control" name="logo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Profile Picture</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="file" class="form-control" name="profile-picture">
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer text-right">
                            <a href="/djmanager" class="btn btn-transparent"><span
                                        class="fa fa-arrow-left"></span> Cancel</a>
                            <input type="submit" class="btn btn-transparent btn-transparent-primary" value="Update Profile" onclick="displayAnimation()">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="title"><span class="fa fa-lightbulb-o"></span> Updating your profile</h4>
                        </div>
                        <div class="panel-body">
                            <p>Make sure to keep your profile information up to date.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="progress hidden" id="progressBar" style="height: fit-content">
            <div class='progress progress-striped active'>
                <div class='progress-bar progress-bar-color' id='bar' role='progressbar' style='width: 100%'>Uploading</div>
            </div>
        </div>
    </div>
    <script src="/js/locationchooser.js"></script>
    <script>
        function displayAnimation()
        {
            $("#progressBar").removeClass('hidden');
        }
    </script>
<script src="/js/jquery-1.12.3.min.js"></script>
<script src="/js/validetta/validetta.js"></script>
<script>
    $(document).ready(function () {
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

        // $(".checkbox").change(function() {
        //     if(this.checked) {
        //         $('.signup').prop('disabled', false);
        //     }else{
        //         $('.signup').prop('disabled', true);
        //     }
        // });

        $('#email').change(function () {
            var email = $('#email').val();
            checkEmail(email);
        });

    });

    function checkEmail(email) {
        $.get('/checkemail/' + email, function (data) {
            console.log(data);
            if (data > 0) {
                $('#email').after('<span class="validetta-bubble validetta-bubble--right" style="top: 257px; left: 553px;">This email is already taken.<br></span>');
            }
        });
    }
</script>
@endsection