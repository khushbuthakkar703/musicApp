@extends('layouts.advertiser')
@section('content')
 <title>SpinStatz | Edit</title>
    <link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>
    <script src="/js/jquery-1.12.3.min.js"></script>
    <div class="container-fluid">
        <form class="form-horizontal" method="post" action="{{route('advertiser.update')}}" id="form">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Information
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <p>The basic required account information</p>
                            <div class="form-group margin-top-15">
                                <label class="col-sm-2 col-xs-12 control-label">Name</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$advertiser->name}}" name="name" data-validetta="required">
                                </div>
                            </div>
                            
                            <!-- 
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Email Address</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="email" class="form-control" value="{{$user->email}}" name="email" data-validetta="required,email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$advertiser->phone_number}}"
                                           name="phone" data-validetta="required">
                                </div>
                            </div> -->

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
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle countryOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$country->id}}" data-validetta="required">

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
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle stateOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$state->id}}" data-validetta="required">
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
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle cityOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" val="{{$city->id}}" data-validetta="required">
                                  </select>
                                </div>
                                @if($errors->has('city'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($user->role === 'advertiser')
                        <div class="panel-heading">
                            Payment Information
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Paypal Email</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control" value="{{$advertiser->paypal_email}}"
                                       name="paypal_email">
                                <p class="note-para">Please enter the PayPal email where you would like to transfer your
                                    earned funds.</p>
                            </div>
                        </div>
                    @endif
                    
                    

                    <div class="panel">
                        <div class="panel-body">

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-sm-2 col-xs-12 control-label">New Password</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="password" class="form-control" name="password" data-validetta="regExp[password],minLength[8]">
                                </div>
                                @if($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Confirm New Password</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="password" class="form-control" name="password_confirmation" data-validetta="minLength[8],equalTo[password]">
                                </div>
                                @if($errors->has('password'))
                                <span class="help-block ">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="../app-pages/profile.html" class="btn btn-transparent"><span
                                        class="fa fa-arrow-left"></span> Cancel</a>
                            <input type="submit" class="btn btn-transparent btn-transparent-primary"
                                   value="Update Profile">
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
    </div>
    <script src="/js/validetta.js"></script>
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
            //checkEmail(email);
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
<script src="/js/locationchooser.js"></script>
<script type="text/javascript">
    document.getElementsByClassName("edit")[0].classList.add('active');
</script>

@endsection