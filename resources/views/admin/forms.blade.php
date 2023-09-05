@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-clipboard page-header-heading-icon"></span> Basic Forms <small>With a few examples...</small></h1>
                <p class="page-header-description">Bootstrap provides you with some great form variants and form element variants. These are displayed below</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="widget widget-default">
                <header class="widget-header">
                    Vertical Form
                </header>
                <div class="widget-body">
                    <form>
                        <label for="username">Username *</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Type your username">
                        <p class="help-block">Enter the username you registered with.</p>
                        <label for="password">Password *</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Type your password">
                        <p class="help-block">And your private password.</p>
                        <div class="clearfix">
                          <input type="checkbox" id="remember_me_1" data-icheck>
                          <label for="remember_me_1" class="icheck-label">
                            Keep me signed in
                          </label>
                        </div>
                        <button type="button" class="btn btn-transparent">Log in</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
        
            <div class="widget widget-default">
                <header class="widget-header">
                    Horizontal Form
                </header>
                <div class="widget-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="username_2">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="username_2" id="username_2" class="form-control" placeholder="Type your username">
                                <p class="help-block">Enter the username you registered with.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="password_2">Password</label>
                            <div class="col-sm-9">
                            <input type="password" name="password_2" id="password_2" class="form-control" placeholder="Type your password">
                            <p class="help-block">And your private password.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                  <input type="checkbox" id="remember_me_2" data-icheck>
                                  <label for="remember_me_2" class="icheck-label">
                                    Keep me signed in
                                  </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                        <button type="button" class="btn btn-transparent">Log in</button></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Inline Form
                </header>
                <div class="widget-body">
                    <form class="form-inline">
                        <p>Please your login details below.</p>
                      <div class="form-group">
                        <label for="email_3">Email</label>
                        <input type="text" class="form-control" name="email_3" id="email_3" placeholder="Jane Doe">
                      </div>
                      <div class="form-group">
                        <label for="password_3">Password</label>
                        <input type="password" class="form-control" id="password_3" placeholder="******">
                      </div>
                      <button type="submit" class="btn btn-transparent btn-transparent">Sign In</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <div class="widget-header">Inline Form (No Labels)</div>
                <div class="widget-body">
                    <form class="form-inline">
                      <p>Forgot your password? Fill in the fields below and we'll send you a reset form.</p>
                      <div class="form-group">
                        <label class="sr-only" for="email_4">Email address</label>
                        <input type="email" class="form-control" name="email_4" id="email_4" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label class="sr-only" for="date_of_birth_4">Date Of Birth</label>
                        <input type="text" class="form-control" id="date_of_birth_4" placeholder="Date Of Birth">
                      </div>
                      <div class="form-group">
                        <input type="checkbox" name="remember_me_4" id="remember_me_4" data-icheck>
                        <label for="remember_me_4" class="icheck-label">
                          Keep me signed in
                        </label>
                      </div>
                      <button type="submit" class="btn btn-transparent btn-transparent">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="widget widget-default">
                <header class="widget-header">
                    Element Sizing
                </header>
                <div class="widget-body">
                    <form>
                        <p>Bootstrap comes with plenty of elemnt sizing options for your inputs.</p>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" placeholder=".input-sm">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Default Size">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" placeholder=".input-lg">
                        </div>
                        <div class="form-group">
                            <select class="form-control input-sm">
                                <option value=".input-sm" selected>.input-sm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control">
                                <option value="Default Size" selected>Default Size</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-lg">
                                <option value=".input-lg" selected>.input-lg</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="widget widget-default">
                <header class="widget-header">
                    Horizontal Form Group Sizing
                </header>
                <div class="widget-body">
                    <form class="form-horizontal">
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="formGroupInputLarge">Large label</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" id="formGroupInputLarge" placeholder="Large input">
                        </div>
                      </div>
                      <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label" for="formGroupInputSmall">Small label</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" id="formGroupInputSmall" placeholder="Small input">
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">Static Control</header>
                <div class="widget-body">
                <form class="form-horizontal">
                  <p>You can use this when you need a non-editable, plain-text control within your form.</p>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <p class="form-control-static">email@example.com</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@include('admin.partials.footer')
</div>
@endsection