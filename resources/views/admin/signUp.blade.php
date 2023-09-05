@extends('layout.adminLoggedOut')

@section('content')
<div class="log-in-wrapper">
    <h1 class="log-in-title">Sign Up<br><small>Create an account to gain access</small></h1>
    <form>
      <div class="form-group">
        <input type="email" class="form-control input-lg" name="email" id="email" placeholder="Your Email Address">
      </div>
      <div class="form-group">
        <input type="email" class="form-control input-lg" name="email_confirmation" id="email_confirmation" placeholder="Confirm Email">
      </div>
      <div class="form-group">
        <input type="text" class="form-control input-lg" name="name" id="name" placeholder="Your Name">
      </div>
      <div class="form-group">
        <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Account Password (min 8 chars)"> 
      </div>
      <div class="form-group">
        <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" data-icheck>
        <label for="terms_and_conditions" class="icheck-label">
          I agree to the <a href="#">terms &amp; conditions</a>
        </label>
      </div>
      <a href="{{ route('admin.signUpSuccess') }}" class="btn btn-transparent btn-lg btn-transparent-primary btn-block">
        Sign Up
      </a>
      <ul class="login-bottom-links">
          <li><a href="{{ route('admin.logIn')}}">Already have an account?</a></li>
      </ul>
    </form>
</div>
@endsection