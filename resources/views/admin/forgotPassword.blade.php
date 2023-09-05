@extends('layout.adminLoggedOut')

@section('content')
<div class="log-in-wrapper">
    <h1 class="log-in-title">Forgot Password<br><small>Enter your email address below to get reset</small></h1>
    <form>
      <div class="form-group">
        <input type="email" class="form-control input-lg" id="email" placeholder="Please enter your email address...">
      </div>
      <a href="{{ route('admin.forgotPasswordSuccess') }}" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">
        Send me a link
      </a>
      <ul class="login-bottom-links">
          <li><a href="{{ route('admin.logIn')}}">Remembered it now?</a></li>
      </ul>
    </form>
</div>
@endsection