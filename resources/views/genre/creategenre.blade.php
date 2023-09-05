@extends('v2.layouts.layout')
@section('content')
<div class="notifications top-right"></div>
<div class="wrapper">
        <div class="page-wrapper">
            <div id="login-hidden" style="display: none;">
                <div class="log-in-wrapper"><img src="../img/SpinstatsApplogo.png" width="300" height="145" alt=""/>
                    <form method="POST" action="{{ route('genrestore') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="genre"  placeholder="Genre name">
                            @if ($errors->has('genre'))
                                <span class="text-danger">
                                            <strong>{{ $errors->first('genre') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <input type="submit" value="Add Genre" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">

                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
