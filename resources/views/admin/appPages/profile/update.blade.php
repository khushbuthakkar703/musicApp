@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-user-add page-header-heading-icon"></span> Update Profile</h1>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <form class="form-horizontal">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="alert alert-info clearfix" role="alert"> <strong>Please check your mail!</strong> You still need to verify your email address.</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Basic Information
                    </div>
                    <div class="panel-body">
                        <p>The basic required account information</p>
                        <div class="form-group margin-top-15">
                            <label class="col-sm-2 col-xs-12 control-label">First Name</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Last Name</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Email Address</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Confirm Email Address</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Contact Details
                    </div>
                    <div class="panel-body">
                        <p>If we or any of our users need to get in touch with you, make your details available here</p>
                        <div class="form-group margin-top-15">
                            <label class="col-sm-2 col-xs-12 control-label">Phone Number</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Contact Email</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Twitter Handle</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Facebook URL</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">YouTube Channel Link</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Location &amp; Career
                    </div>
                    <div class="panel-body">
                        <div class="form-group has-warning margin-top-15">
                            <label class="col-sm-2 col-xs-12 control-label">Where are you based?</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                                <p class="help-block">It's best to let people know where your based if you've let them know your current occupation.</p>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-sm-2 col-xs-12 control-label">Who do you work for?</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control" value="Admin Corp">
                            </div>
                        </div>
                        <div class="form-group has-error">
                            <label class="col-sm-2 col-xs-12 control-label">What is your job role?</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" class="form-control">
                                <p class="help-block">Please enter your job role.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">New Password</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Confirm New Password</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <a href="{{ route('admin.appPages.profile') }}" class="btn btn-transparent"><span class="fa fa-arrow-left"></span> Cancel</a>
                        <button type="button" class="btn btn-transparent btn-transparent-primary"><span class="fa fa-share"></span> Update Profile</button>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="title"><span class="fa fa-lightbulb-o"></span> Updating your profile</h4>
                    </div>
                    <div class="panel-body">
                        <p>Make sure to keep your profile information up to date.</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="/js/summernote.css">
@endsection

@section('scripts')
<script src="/js/summernote.min.js"></script>
<script src="/js/pages/compose-message.js"></script>
@endsection