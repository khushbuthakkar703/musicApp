@extends('v2.layouts.layout')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('invite') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <br>
                <div class="col-md-6" style="color: black">
                    {{--<label style="color: white;">Choose user type</label>--}}
                    <div class="form-group">
                        <select name="role" class="form-control" required>
                            <option value="" disabled selected hidden>Please Choose User Type</option>

                            <option value="djmanager">DJ Manager</option>
                            <option value="dj">DJ</option>

                        </select>
                    </div>
                </div>
            </div>


        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Send Invitation Link
                </button>
            </div>
        </div>

    </form>
@endsection
