@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('djregister') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('invitationcode') ? ' has-error' : '' }}">
            {{--<label for="invitationcode" class="col-md-4 control-label">Invitation Code</label>--}}

            <div class="col-md-6">
                <input id="invitationcode" type="text" class="form-control" name="invitationcode" value="{{ $code }}" required placeholder="Invitation Code">

                @if ($errors->has('invitationcode'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('invitationcode') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
            {{--<label for="firstName" class="col-md-4 control-label">First Name</label>--}}

            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required placeholder="First Name">

                @if ($errors->has('firstname'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                @endif
            </div>

        </div>

        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
            {{--<label for="lastName" class="col-md-4 control-label">Last Name</label>--}}

            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required placeholder="Last Name">

                @if ($errors->has('lastname'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                @endif
            </div>

        </div>

        <div class="form-group{{ $errors->has('djName') ? ' has-error' : '' }}">
            {{--<label for="djName" class="col-md-4 control-label">DJ Name</label>--}}

            <div class="col-md-6">
                <input id="djname" type="text" class="form-control" name="djname" value="{{ old('djname') }}" required placeholder="DJ Name">

                @if ($errors->has('djname'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('djname') }}</strong>
                                    </span>
                @endif
            </div>

        </div>

        <div class="form-group{{ $errors->has('clubName') ? ' has-error' : '' }}">
            {{--<label for="clubName" class="col-md-4 control-label">Club/Station Name</label>--}}

            <div class="col-md-6">
                <input id="clubname" type="text" class="form-control" name="clubname" value="{{ old('clubname') }}" required placeholder="Club/Station Name">

                @if ($errors->has('clubname'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('clubname') }}</strong>
                                    </span>
                @endif
            </div>

        </div>



        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ $email }}" required placeholder="Email Address where you got invitation">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
            </div>
        </div>
        
        @foreach($musicTypes as $musicType)
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label><input type="checkbox" name="musictype[]" value="{{$musicType->id}}" {{ old('remember') ? 'checked' : '' }}>{{$musicType->name}}</label>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>

    </form>
@endsection
