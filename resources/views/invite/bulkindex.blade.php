@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('bulkinvite') }}">
    {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address in lines</label>

            <div class="col-md-6">
                
                <textarea id="email" type="email" class="form-control" name="emails" required></textarea>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>

        </div>



        <div class="form-group">s
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Send Invitation Link
                </button>
            </div>
        </div>

    </form>
@endsection
