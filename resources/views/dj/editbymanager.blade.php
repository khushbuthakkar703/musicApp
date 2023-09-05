@extends('layouts.djmanager')
@section('content')
    <title>SpinStatz | {{$dj->dj_name}}</title>
    <div class="container-fluid">
        <form class="form-horizontal" method="post" action="{{Route('dj.update', $dj->id)}}">
            <div class="row">
                {{ method_field('PATCH') }}
                <div class="col-xs-12 col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Information
                        </div>
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <p>The basic required account information</p>
                            <div class="form-group margin-top-15">
                                <label class="col-sm-2 col-xs-12 control-label">First Name</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->first_name}}" name="fname">
                                </div>
                                @if($errors->has('fname'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Last Name</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->last_name}}" name="lname">
                                </div>
                                @if($errors->has('lname'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">DJ Name</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->dj_name}}" name="djname">
                                </div>
                                @if($errors->has('djname'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('djname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Software</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->software}}" name="software" required>
                                </div>
                                @if($errors->has('software'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('software') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Phone</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->phone_number}}" name="phone" required>
                                </div>
                                @if($errors->has('phone'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
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
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle countryOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$country->id}}">

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
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle stateOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" val="{{$state->id}}" required>
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
                                  <select id="btnGroupVerticalDrop1 " type="button" class="btn btn-default dropdown-toggle cityOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city" val="{{$city->id}}" required>
                                  </select>
                                </div>
                                @if($errors->has('city'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="col-sm-2 col-xs-12 control-label">Address</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->address}}" name="address">
                                
                                @if($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label class="col-sm-2 col-xs-12 control-label">Zipcode</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" value="{{$dj->zipcode}}" name="zipcode">
                                     @if($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->role === 'dj')
                        <div class="panel-heading">
                            Payment Information
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Paypal Email</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control" value="{{$dj->paypal_email}}"
                                       name="paypal_email">
                                <p class="note-para">Please enter the PayPal email where you would like to transfer your
                                    earned funds.<br> <a href="#" class="btn btn-faded-blue">Link PayPal Account</a></p>
                            </div>
                        </div>
                    @endif

                    <div class="panel">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">New Password</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Confirm New Password</label>
                                <div class="col-sm-10 col-xs-12">
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="https://spinstatz.net/djmanager" class="btn btn-transparent"><span
                                        class="fa fa-arrow-left"></span> Cancel</a>
                            {{--<button type="button" class="btn btn-transparent btn-transparent-primary"><span class="fa fa-share"></span> Update Profile</button>--}}
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
        </form>
    </div>
@endsection
<script src="/js/jquery-1.12.3.min.js"></script>
<script src="/js/locationchooser.js"></script>
