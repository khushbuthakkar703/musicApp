@extends('layouts.djapp')
@section('content')
<link rel="stylesheet" type="text/css" href="/css/custom.css">
<title>SpinStatz | Edit</title>
<link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>
<script src="/js/jquery-1.12.3.min.js"></script>
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content profile_setting">
        <div class="background-user" style="position: relative;">
            <div class="content">
                <div class="mdl-grid mb-3">
                    <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
                        <h3 id="user-dashboard ml-unset">Account Settings</h3>
                    </div>
                </div>
            </div>
        </div>
            <div class="container margin-over">
                <div class="col-md-12 pl-0 sm-pr-0">
                    <form class="form-horizontal" method="post" action="{{Route('dj.update', $dj->id)}}" id="form">
                         {{ method_field('PATCH') }}
                            <div class="card-deck mt-4 col-12">
                                <div class="card col-md-8 remove_margin col-md-8">
                                    <div class="card-body m-3" style="color:rgb(132, 255, 255);">  
                                        <div class="detils_tag">
                                            {{ csrf_field() }}
                                            <p class="card-text mt-2" style="font-size: x-large; color:#FFF">Basic Information</p>
                                        </div>
                                        <div class="input_fild">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">First Name</label>
                                                <div class="dropdown col-md-6 my-3">
                                                   <input type="text" class="form-control" value="{{$dj->first_name}}" name="fname" data-validetta="required">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Last Name</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" value="{{$dj->last_name}}" name="lname" data-validetta="required">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Dj Name</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" value="{{$dj->dj_name}}" name="djname" data-validetta="required">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Email Adress</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="email" class="form-control" value="{{$dj->user->email}}" name="email" data-validetta="required,email">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Phone Number</label>
                                                <div class="dropdown col-md-6 my-3">
                                                   <input type="text" class="form-control" value="{{$dj->phone_number}}"name="phone" data-validetta="required">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Software</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" value="{{$dj->software}}" name="software" data-validetta="required">
                                                </div>
                                            </div>
                                           
                                        </div>
                                          
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-20 text-center sm-mt-20 mange_clubs">
                                        <div class="card-body m-3" style="color:rgb(132, 255, 255);">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="title"><span class="fa fa-lightbulb-o"></span> Manage Your Clubs</h4>
                                                </div>
                                                <div class="panel-body">
                                                    @foreach($clubs as $club)
                                                        <li ><a href="{{($dj->id)}}">{{$club->name}}</a></li>
                                                    @endforeach
                                                </div>
                                                <a href="/djlogin/success" style="margin-left: 10px">Add More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-deck mt-4 col-12">
                                <div class="card col-md-8 ml-0">
                                    <div class="card-body m-3" style="color:rgb(132, 255, 255);">
                                        <div class="input_fild">
                                            @if(Auth::user()->role === 'dj')
                                                <div class="d-flex align-items-center row">
                                                    <label for="" class="col-md-6">Paypal Email</label>
                                                    <div class="dropdown col-md-6 my-3">
                                                        <input type="text" class="form-control" value="{{$dj->paypal_email}}"name="paypal_email">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center row">
                                                    <label for="" class="col-md-6"></label>
                                                    <div class="dropdown col-md-6 my-3">
                                                         <p class="note-para" style="line-height: 1.3; color: #FFF;">( Please enter the PayPal email where you would like to transfer your earned funds. )</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>    
                                    </div>
                                </div>  
                            </div>     

                            <div class="card-deck mt-4 col-12">
                                <div class="card col-md-8 ml-0">
                                    <div class="card-body m-3" style="color:rgb(132, 255, 255);">
                                        <div class="detils_tag">
                                            <p class="card-text mt-2" style="font-size: x-large; color:#FFF">Socail media</p>
                                        </div>
                                        <div class="input_fild {{ $errors->has('soundcloud') ? ' has-error' : '' }}">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="mt-3 col-md-6">Soundcloud</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" name="soundcloud" value="{{$dj->soundcloud}}" placeholder="Username Only">
                                                </div>
                                                @if($errors->has('soundcloud'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('soundcloud') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>    
                                        <div class="input_fild {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="mt-3 col-md-6">Facebook</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" name="facebook" value="{{$dj->facebook}}" placeholder="Username Only">
                                                </div>
                                                @if($errors->has('facebook'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('facebook') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>    
                                        <div class="input_fild {{ $errors->has('instagram') ? ' has-error' : '' }}">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="mt-3 col-md-6">Instagram</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" name="instagram" value="{{$dj->instagram}}" placeholder="Username Only">
                                                </div>
                                                @if($errors->has('instagram'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('instagram') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>    

                                        <div class="input_fild {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="mt-3 col-md-6">Twitter</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" name="twitter" value="{{$dj->twitter}}" placeholder="Username Only">
                                                </div>
                                                 @if($errors->has('twitter'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('twitter') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>    
                                        <div class="input_fild {{ $errors->has('youtube') ? ' has-error' : '' }}">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="mt-3 col-md-6">Youtube</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" name="youtube" value="{{$dj->youtube}}" placeholder="Username Only">
                                                </div>
                                                @if($errors->has('youtube'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('youtube')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>    
                                    </div>
                                </div>  
                            </div> 

                            <div class="card-deck mt-4 col-12">
                                <div class="card col-md-8 ml-0">
                                    <div class="card-body m-3" style="color:rgb(132, 255, 255);">  
                                        <div class="detils_tag">
                                            <p class="card-text mt-2" style="font-size: x-large; color:#FFF">Billing information</p>
                                        </div>
                                        <div class="input_fild">
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Adress</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" value="{{$dj->address}}" name="address" data-validetta="required">
                                                    @if($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Country</label>
                                                <div class="dropdown col-md-6 my-3">
                                                <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle countryOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$country->id}}" data-validetta="required">
                                                </select>
                                                </div>
                                                @if($errors->has('country'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">State</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle stateOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$state->id}}" data-validetta="required">
                                                    </select>
                                                    </div>
                                                    @if($errors->has('state'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">City</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle cityOption form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" val="{{$city->id}}" data-validetta="required">
                                                    </select>
                                                </div>
                                                    @if($errors->has('city'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Street</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Zip Code</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="text" class="form-control" value="{{$dj->zipcode}}" name="zipcode" data-validetta="required">
                                                    @if($errors->has('zipcode'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('zipcode') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>  
                            </div>
                            
                            <div class="card-deck mt-4 col-12">        
                                <div class="card ml-0 col-md-8">
                                    <div class="card-body m-3" style="color:rgb(132, 255, 255);">          
                                        <div class="detils_tag">
                                            <p class="card-text mt-2" style="font-size: x-large; color:#FFF">Change Password</p>
                                        </div>
                                        <div class="input_fild">
                                            <div class="d-flex align-items-center row {{ $errors->has('password') ? ' has-error' : '' }}" >
                                                <label for="" class="col-md-6">New password</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="password" class="form-control" name="password" data-validetta="regExp[password],minLength[8]">
                                                </div>
                                                @if($errors->has('password'))
                                                    <span class="help-block ">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center row">
                                                <label for="" class="col-md-6">Confirm password</label>
                                                <div class="dropdown col-md-6 my-3">
                                                    <input type="password" class="form-control" name="password_confirmation" data-validetta="minLength[8],equalTo[password]">
                                                </div>
                                                @if($errors->has('password'))
                                                    <span class="help-block ">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="change_btn">
                                                <input type="submit" class="card-text mt-2 btn btn-transparent btn-transparent-primary"
                                                value="Change">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        
                    </form>  
                </div>  
            </div>  
            <div>
                <p></p>
            </div>     
    </main>
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
            },
            onError : function( event ){
                event.preventDefault();
                return false;
            }
        });


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
    // document.getElementsByClassName("edit")[0].classList.add('active');
</script>

@endsection