@extends('layouts.djmanagerregister')
@section('content')
<link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>

<style> 
/* 18-07-2018 */
.page-header{ margin-bottom: 20px;background: rgb(36, 41, 44) !important; }
.redesign-form-body .widget .widget-header {    background: rgb(28, 31, 33); }
.redesign-form-body select {   -moz-appearance: none;  /* for Chrome */  -webkit-appearance: none; text-align:left; position:relative; }
.redesign-form-body .select_group{ position:relative; }
.redesign-form-body .select_group::after {  content: "\f0dc";   font-family: FontAwesome;   color: #bfbfbf; /* padding: 12px 8px; */    position: absolute; right: 1px; top: 1px;   z-index: 1; text-align: center; width: 25px;    pointer-events: none;   box-sizing: border-box; height: 32px;   line-height: 34px;  text-align: center; padding-left: 2px;}
.redesign-form-body .widget-body input, .redesign-form-body .widget-body select {   background: #40484b;    border-radius: 0px;}
.redesign-form-body .validetta-bubble {
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
body .redesign-form-body .widget-body select:focus,body .redesign-form-body .widget-body select:active,body .redesign-form-body .widget-body select:hover{ background:#40484b; color:#fff; box-shadow:none; border:1px solid rgba(255, 255, 255, 0.2); }
.redesign-form-body .open > .dropdown-toggle.btn-default{ background:#40484b; border:0px; }
.widget.widget-default {background: rgb(36, 41, 44) !important; }
.redesign-form-body option{ color:#fff !important; }
.redesign-form-body .validetta-bubble{ min-width:200px; }
.redesign-form-body .validetta-bubble { min-width: auto;
    padding: 3px 7px;
    position: static;
    width: 100%;
    max-width: none;
    border-radius: 0;
    font-style: italic;}
.padding-left-0{ padding-left:0px; }
.padding-right-0{ padding-right:0px;  }
body .width100{ width:100% !important; }
.redesign-form-body .widget-body > div {    margin-bottom: 10px; clear: both; overflow: hidden; }
.redesign-table-widget .form-group {    margin-bottom: 0px; color:#a5a5a5; }
.redesign-table-widget .icheck-label {	margin-left: 0px;	font-size: 15px;	top: 5px;	position: relative;	left: -13px;}
.footer-widgets-design{     height: auto;    min-height: auto;    clear: both;    overflow: hidden;    padding: 20px 15px; } 
.redesign-text-right{ text-align:right }
.content-wrapper-footer {   background: #333;   text-align: center; padding: 10px;}
.top_error_container.top_container {
    margin-bottom: 0px !important;
    padding-bottom: 24px;
}
.top_error_container.top_container .validetta-bubble {
    top: 34px !important;
    left: 0px !important;
    position: absolute;
    min-width: 160px;
}
.top_error_container .top_error {
    position: relative;
}
.validetta-bubble:before {content: ''; 
     position: unset;
     display: none; 
     height: 0;
     width: 0; 
     border-width: 0px; 
    border-style: solid; }

@media screen and (max-width:980px){
    .padding-left-0,.padding-right-0{ padding:0px; }
    .mobile-margin-handle{ margin-bottom:10px; }
    .form-inline .form-group{ display:inline-block; margin-bottom:0px; }
    .redesign-text-right {  text-align: center; margin-top: 10px;   display: block; clear: both;    overflow: hidden;   padding-top: 14px;}
    
    .redesign-form-body .validetta-bubble { min-width: auto; padding: 3px 7px; position: static;    width: 100%;    max-width: none;    border-radius: 0;   font-style: italic;}
    .redesign-form-body .validetta-bubble::before { border-style: none; }
    .form-inline > div {    display: block !important;  margin-bottom: 10px !important; margin-right:0px !important;}
    .form-inline{ margin-bottom:0px !important; }
    .form-inline > div select,.form-inline > div input{ width:100% !important; max-width:unset !important; }
}   

@media screen and (max-width:600px){
    .dj_total_group{ display:block !important; }
    #dj_total { margin-top: 10px; }
    .redesign-table-widget .icheck-label {  top: 5px;left: 0px; }
    .form-inline .form-group input{ max-width:120px; }
    #dj_total{ max-width:none; }
}
</style>

<div class="content-dimmer"></div>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-clipboard page-header-heading-icon"></span>
                Registration Form</h1>
                <p class="page-header-description">DJ Managers please fill out the form below to begin the validation
                process of your DJ organization.</p>
            </div>
        </div>
    </div>
</header>
<div class="redesign-form-body">
    <form method="post" action="{{ route('djmanager.store') }}" id="form">
        {{ csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="widget widget-default">
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
                        <header class="widget-header">
                            Create Your Login
                        </header>
                        <div class="widget-body">
                            <div>
                                <label for="username">Username *</label>
                                <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control " placeholder="Type your username" data-validetta="required">
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div>
                                <label for="email">Email Address *</label>
                                <input name="email" id="email" value="{{$reciptant}}" class="form-control"
                                placeholder="Type your email address" data-validetta="required,email">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div>
                                <label for="password">Password *</label>
                                <input type="password" name="password" value="{{old('password')}}" id="password"
                                class="form-control" placeholder="Type your password" data-validetta="required,,regExp[password],minLength[8]">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div>
                                <label for="password">Confirm Password *</label>
                                <input type="password" name="password" value="{{old('password')}}" id="password"
                                class="form-control" placeholder="Type your password" data-validetta="required,equalTo[password]">
                                @if ($errors->has('confirmPassword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('confirmPassword') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="widget widget-default">
                        <header class="widget-header">Contact Information</header>
                        <div class="widget-body">
                            <div class="form-inline">
                                <div class="col-md-6 padding-left-0 mobile-margin-handle">
                                    <div class="">
                                        <label class="sr-only" for="firstname">First Name</label>
                                        <input type="text" value="{{old('firstname')}}" class="form-control width100" name="firstname" id="firstname" placeholder="First Name" data-validetta="required">
                                        @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 padding-right-0">
                                    <div class="">
                                        <label class="sr-only" for="lastname">Last Name</label>
                                        <input type="text" value="{{old('lastname')}}" class="form-control width100" id="lastname"
                                        placeholder="Last Name" name="lastname" data-validetta="required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 padding-left-0 padding-right-0">
                                <div class="" role="group">
                                    <label class="sr-only" for="lastname">Country</label>
                                    <div class="select_group">
                                        <select id="btnGroupVerticalDrop1 " type="button" class="form-control btn btn-default dropdown-toggle countryOption1" data-toggle="dropdown" aria-haspopup="true" data-validetta="required" aria-expanded="false" name="country">
                                            
                                        </select>
                                    </div>
                                    @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12 padding-left-0 padding-right-0">
                                <label for="address">Street Address *</label>
                                <input type="text" name="address" value="{{old('address')}}" id="address"
                                class="form-control" placeholder="Type your address" data-validetta="required">
                                @if ($errors->has('streetaddress'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('streetaddress') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-inline country-state-city top_error_container">
                                <div class="form-group">
                                    <label class="sr-only" for="state">*State</label>
                                    <!-- <input name="state" type="text" value="{{old('state')}}" class="form-control" id="state"
                                    placeholder="State*" size="10" maxlength="10" data-validetta="required"> -->
                                    <div class="select_group"><select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle stateOption1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="state"></select></div>
                                    @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group top_error">
                                    <label class="sr-only" for="city">*City</label>
                                    <!-- <input name="city" type="text" value="{{old('city')}}" class="form-control" id="city"
                                    placeholder="City*" size="15" maxlength="15" data-validetta="required"> -->
                                    <div class="select_group"><select id="btnGroupVerticalDrop1 "  type="button" class="btn btn-default dropdown-toggle cityOption1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city"></select></div>
                                    @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="form-group top_error">
                                    <label class="sr-only" for="zipcode">*Zipcode</label>
                                    <input name="zipcode" value="{{old('zipcode')}}" type="text" class="form-control"
                                    id="zipcode" placeholder="zipcode*" size="5" maxlength="5"
                                    data-validetta="required">
                                    @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <div class="col-md-6 padding-left-0 mobile-margin-handle">
                                    <div class="">
                                        <label class="sr-only" for="phone">*Enter valid Phone Number</label>
                                        <input name="phone" type="text" value="{{old('phone')}}" class="form-control" id="phone"
                                        placeholder="Enter Valid Phone Number*" size="19" maxlength="19"
                                        data-validetta="required">
                                        @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 padding-right-0">
                                    <div class="">
                                        <label class="sr-only" for="cemail">*Enter valid Email Address</label>
                                        <input name="cemail" type="text" value="{{old('email')}}" class="form-control"
                                        id="cemail" placeholder="Enter Valid Email Address*" size="25" maxlength="35"
                                        data-validetta="required">
                                        @if ($errors->has('cemail'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cemail') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="widget widget-default">
                        <header class="widget-header">Coalition Information</header>
                        <div class="widget-body">
                            <div class="">
                                <div class="col-sm-12 padding-left-0 padding-right-0">
                                    <input type="text" class="form-control" name="invitationcode" value="{{$code}}">
                                    <p class="help-block"><span class="fa fa-lock list-group-item-icon"></span> Please enter
                                    your DJ Manager Invite Code.</p>
                                </div>
                            </div>
                            <div>
                                <label for="companyname">Company Name *</label>
                                <input type="text" name="companyname" value="{{old('companyname')}}" id="companyname"
                                class="form-control" placeholder="Type your companyname" data-validetta="required">
                            </div>
                            <div>
                                <label for="caddress">Company Address *</label>
                                <div >
                                    <input type="text" name="companyaddress" value="" id="caddress" class="form-control" placeholder="Type your address" data-validetta="required">
                                </div>
                             </div>
                                <div role="group">
                                    <div class="select_group"><select id="btnGroupVerticalDrop1 " type="button" class="btn form-group countryOption"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="companycountry" data-validetta="required" style="margin-bottom:0px; width: 100%;">

                                    </select></div>
                                </div>
                                @if ($errors->has('companycountry'))
									<span class="help-block">
										<strong>{{ $errors->first('companycountry') }}</strong>
									</span>
                                @endif
                            <div class="form-inline top_error_container">
                                <div class="form-group top_error">
                                    <label class="sr-only" for="statecompany">*State</label>
                                    <div class="select_group"><select id="btnGroupVerticalDrop1" type="button" class="btn btn-default dropdown-toggle stateOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="companystate"></select></div>
                                    <!-- <input name="statecompany" type="text" value="{{old('statecompany')}}"
                                    class="form-control" id="statecompany" placeholder="State*" size="10"
                                    maxlength="10" data-validetta="required"> -->
                                    @if ($errors->has('companystate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companystate') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            <div class="form-group">
                                <label class="sr-only" for="companycity">*City</label>
                                <div class="select_group"><select id="btnGroupVerticalDrop1" type="button" class="btn btn-default dropdown-toggle cityOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="companycity"></select></div>
                                <!-- <input name="companycity" value="{{old('companycity')}}" type="text"
                                class="form-control" id="companycity" placeholder="City*" size="15"
                                maxlength="15" data-validetta="required"> -->
                                @if ($errors->has('companycity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('companycity') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                                <div class="form-group top_error">
                                <label class="sr-only" for="companyzipcode">*Zipcode</label>
                                <input name="companyzipcode" value="{{old('companyzipcode')}}" type="text"
                                class="form-control" id="companyzipcode" placeholder="zipcode*" size="5"
                                maxlength="5" data-validetta="required">
                                @if ($errors->has('companyzipcode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('companyzipcode') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-inline">
                                <div class="form-group top_error">
                                <label class="sr-only" for="taxid">Tax ID Number *</label>
                                <input name="taxid" value="{{old('taxid')}}" type="text" class="form-control" id="taxid"
                                placeholder="Tax ID # *" size="10" maxlength="10" data-validetta="required">
                                @if ($errors->has('taxid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('taxid') }}</strong>
                                </span>
                                @endif
                            </div>
                                <div class="form-group top_error">
                                <label class="sr-only" for="year_created">Year Created *</label>
                                <input name="year_created" value="{{old('year_created')}}" type="text"
                                class="form-control" id="Year_created" placeholder="Year Created*" size="10"
                                maxlength="10" data-validetta="required">
                                @if ($errors->has('year_created'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('year_created') }}</strong>
                                </span>
                                @endif
                            </div>
                                <div class="form-group dj_total_group top_error">
                                <label class="sr-only" for="dj_total">Total Number of DJs</label>
                                <input name="dj_total" value="{{old('dj_total')}}" type="number" class="form-control"
                                id="dj_total" placeholder="DJ Total*" size="10" maxlength="10"
                                data-validetta="required">
                                @if ($errors->has('dj_total'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dj_total') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                            <div>
                        <input type="url" value="{{old('weburl')}}" name="weburl" id="weburl" class="form-control"
                        placeholder="Website URL Example http://www.website.com">
                        @if ($errors->has('weburl'))
                        <span class="help-block">
                            <strong>{{ $errors->first('weburl') }}</strong>
                        </span>
                        @endif
                            </div>
                            <div>
                        <input type="text"  value="{{old('FBook')}}" name="FBook" id="Fbook" class="form-control"
                        placeholder="Facebook Page Example http://www.facebook.com/username">
                        @if ($errors->has('fbook'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fbook') }}</strong>
                        </span>
                        @endif
                            </div>
                            
                            <div>
                                <input type="text" value="{{old('instagram')}}" name="instagram" id="instagram"
                                class="form-control"
                                placeholder="Instagram Page Example http://www.instagram.com/username">
                                @if ($errors->has('instagram'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('instagram') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div>
                                <input type="text" value="{{old('TW')}}" name="TW" id="TW" class="form-control"
                                placeholder="Twitter Example http://www.twitter.com/username">
                                @if ($errors->has('tw'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tw') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="widget widget-default">
                        <header class="widget-header">
                            Select all music genres that your organization supports
                        </header>
                        <div class="widget-body redesign-table-widget">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr><p class="help-block">(Check all That Apply)</p>

                                        @for($i=0; $i < count($musicTypes)/2; $i++)
                                        <tr>
                                            <td>
                                             
                                                <div class="form-group">
                                                    <input type="checkbox" name="musictype[]" id="terms_and_conditions" data-icheck
                                                    value="{{$musicTypes[$i*2]->id}}" 
														@if(in_array($musicTypes[$i*2]->id,(array) old('musictype')))checked @endif
                                                    >
                                                    <!--<label for="terms_and_conditions" class="icheck-label"></label>-->
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="terms_and_conditions" class="icheck-label">{{$musicTypes[$i*2]->name}}</label>
                                                </div>
                                            </td>
                                            @if(count($musicTypes) <= $i*2+1)
                                            @break
                                            @endif
                                            <td>
                                                <div class="form-group">
                                                    <input type="checkbox" name="musictype[]" id="terms_and_conditions" data-icheck
                                                    value="{{$musicTypes[$i*2+1]->id}}" 
														@if(in_array($musicTypes[$i*2+1]->id,(array) old('musictype')))checked @endif
                                                    >
                                                    <!--<label for="terms_and_conditions" class="icheck-label"></label>-->
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="widget widget-default footer-widgets-design">
                <div class="col-md-6">
                    <div style="float: left;">
                        <input type="checkbox" style="float: left; margin-right: 10px;" class="checkbox"><a href="#" data-toggle="modal" data-target="#myModal">Accept Terms
                        Of Condition</a>
                    </div>
                </div>
                <div class="col-md-6 redesign-text-right">
                    <input type="submit" class="btn btn-success signup" value="Submit Registration" disabled>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="position: relative; z-index: 909090;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Terms and Conditions</h4>
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


<script src="/js/jquery-1.12.3.min.js"></script>
<script src="/js/validetta/validetta.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>

    var options= {
        inputWrapperClass: 'form-field',
        onError: function(){
            $('.top_error').parent().addClass('top_container');
        },
        validators: {
                regExp: {
                    password: {
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/,
                        errorMessage: 'Password must include uppercase, lowercase and number'
                    }
                }
            }
    };
    $(document).ready(function () {
        $('#form').validetta(options);
        $(".checkbox").change(function() {
            if(this.checked) {
                $('.signup').prop('disabled', false);
            }else{
                $('.signup').prop('disabled', true);
            }
        });
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
<script>
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
<script type="text/javascript">
    $(document).ready(function(){
	
	var country_selected = '{{ old('country') }}';
	var state_selected = '{{ old('state') }}';
	var city_selected = '{{ old('city') }}';
	
	var country_selected1 = '{{ old('companycountry') }}';
	var state_selected1 = '{{ old('companystate') }}';
	var city_selected1 = '{{ old('companycity') }}';	
	
    $.get( "/countries", function( data ) {
        $('.countryOption1').append('<option></option>');
        $('.countryOption1').append('<option value="231"> United States</option>');
        value = $('.countryOption1').attr("val");
        $.each(data,function(index,stateObject){
            if(value == stateObject.id){
                appende = '<option  value="'+stateObject.id+'" selected>'+stateObject.name + '</option>';
            }
            else{
                appende = '<option  value="'+stateObject.id+'">'+stateObject.name + '</option>';
            }
            $('.countryOption1').append(appende);
        });

        country = $( ".countryOption1" ).val();
        loadState1(country);
        
        if(country_selected!=""){
			$('.countryOption option[value='+ parseInt(country_selected) +']').prop('selected',true);
			$('.countryOption').trigger('change');
		}
		
		if(country_selected1!=""){
			$('.countryOption1 option[value='+ parseInt(country_selected1) +']').prop('selected',true);
			$('.countryOption1').trigger('change');
		}
        
    });

    $('.countryOption1').change(function(element){
        $('.stateOption1').html('');
        $('.cityOption1').html('');
        loadState1(this.value);
        
        if(state_selected1!=""){
			//alert('.stateOption option[value='+ parseInt(state_selected) +']');
			setTimeout(function(){
				$('.stateOption1 option[value='+ parseInt(state_selected1) +']').prop('selected',true);
				$('.stateOption1').trigger('change');
			},1000);
		}
    })

    $('.stateOption1').change(function(element){
        $('.cityOption1').html('');
        loadCity1(this.value);
        
        if(city_selected1!=""){
			//alert('.cityOption option[value='+ parseInt(city_selected) +']');
			setTimeout(function(){
				$('.cityOption1 option[value='+ parseInt(city_selected1) +']').prop('selected',true);
				$('.cityOption1').trigger('change');
			},1000);
		}
		
    })

});

function loadState1(country){
  $.get( "/country/states/"+country, function( data ) {
    $('.stateOption').append('<option></option>');
    value = $('.stateOption1').attr("val");
    $.each(data,function(index,stateObject){
        //console.log(value,stateObject.id)
        if(value == stateObject.id){
            $('.stateOption1').append('<option  value="'+stateObject.id+'" selected>'+ stateObject.name + '</option>');
        }else{
            $('.stateOption1').append('<option  value="'+stateObject.id+'">'+ stateObject.name + '</option>');
        }
    });

    state = $( ".stateOption1" ).val();
    loadCity(state)
  })
}


function loadCity1(state){
  $.get( "/state/cities/"+state, function( data ) {
    //$('.cityOption').
    value = $('.cityOption1').attr("val");
    $('.cityOption1').append('<option></option>');
        $.each(data,function(index,stateObject){
            if(value == stateObject.id){
                $('.cityOption1').append('<option  value="'+stateObject.id+'"selected>'+stateObject.name + '</option>');
            }else{
                $('.cityOption1').append('<option  value="'+stateObject.id+'">'+stateObject.name + '</option>');
            }
        });    
    //loadData()
  });
}
</script>
@endsection
