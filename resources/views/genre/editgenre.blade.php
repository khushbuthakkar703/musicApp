@extends('layouts.admin')
@section('content')
<div class="page-wrapper">

    <div id="login-hidden" style="display: none;">
        <div class="log-in-wrapper"><img src="../../img/SpinstatsApplogo.png" width="300" height="145" alt=""/>

            {{ Form::open(['route' => ['updategenre', $genre->id], 'method' => 'post']) }}
            {{ csrf_field() }}
            <h2> Edit Genre</h2>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="genre" value="{{$genre->name}}" required>
                    @if ($errors->has('genre'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                </span>
                    @endif
                </div>
                <input type="submit" value="Update Genre" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">

            {{Form::close()}}
        </div>
    </div>
</div>
@endsection