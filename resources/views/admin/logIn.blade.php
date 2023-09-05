@extends('layout.adminLoggedOut')

@section('content')
<div class="log-in-wrapper">
    @if( ! empty($forgotPasswordComplete))
        <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Success! Check your inbox now</div>
    @endif
    @if( ! empty($signUpComplete))
        <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Success! Log in now</div>
    @endif
    <h1 class="log-in-title">Welcome to <strong class="text-primary">Varello</strong>Admin<br><small>Please enter your details</small></h1>
    <form>
      <div class="form-group">
        <input type="email" class="form-control input-lg" id="email" placeholder="Please enter your email address...">
      </div>
      <div class="form-group">
        <input type="password" class="form-control input-lg" id="password" placeholder="And your password..."> 
      </div>
      <div class="form-group">
        <input type="checkbox" id="remember_me" data-icheck>
        <label for="remember_me" class="icheck-label">
          Keep me signed in
        </label>
      </div>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">
        Log In
      </a>
      <ul class="login-bottom-links">
          <li><a href="{{ route('admin.forgotPassword') }}">Forgot your password?</a></li>
          <li><a href="{{ route('admin.signUp') }}">Need an account?</a></li>
      </ul>
    </form>
</div>
@endsection