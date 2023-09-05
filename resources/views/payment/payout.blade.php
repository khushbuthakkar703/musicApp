@extends('layouts.app')
@section('content')
<form class="form-horizontal" method="POST" action="{{ route('payout') }}">
      {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="amount" class="col-md-4 control-label">Amount</label>

              <div class="col-md-6">
                  <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" required>

                  @if ($errors->has('amount'))
                    <span class="help-block">
                      <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                  @endif
		  @if (session('alert'))
   		    <div class="alert alert-success">
       			{{ session('alert') }}
   	            </div>
		  @endif
              </div>

         </div>
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		      <label for="email" class="col-md-4 control-label">Recipient Email</label>

		      <div class="col-md-6">
		          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

		          @if ($errors->has('email'))
		            <span class="help-block">
		              <strong>{{ $errors->first('email') }}</strong>
		            </span>
		          @endif
			  @if (session('alert'))
	   		    <div class="alert alert-success">
	       			{{ session('alert') }}
	   	            </div>
			  @endif
		      </div>

        </div>



         <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    SEND
                </button>
            </div>
        </div>

</form>
@endsection