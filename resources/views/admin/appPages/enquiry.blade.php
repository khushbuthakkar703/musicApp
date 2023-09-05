@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-message page-header-heading-icon"></span> Got A Support Enquiry?</h1>
                <p class="page-header-description">We're here for you 24/7, whether it's phone, email or support directly through the application</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <form class="form-horizontal">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Your Query
                    </div>
                    <div class="panel-body">
                        <p>Please provide us with as much information as possible regarding your query.</p>
                        <div class="form-group margin-top-15">
                            <label class="col-sm-2 col-xs-12 control-label">Your Name</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Your Email Address</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Your Phone Number</label>
                            <div class="col-sm-10 col-xs-12">
                                <input type="email" name="email_confirmation" id="email_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Contact Me By...</label>
                            <div class="col-sm-10 col-xs-12">
                                <select name="contact_me_by" id="contact_me_by" class="form-control">
                                    <option value="0">Phone</option>
                                    <option value="1">Email</option>
                                    <option value="2">Direct Message</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Your Query</label>
                            <div class="col-sm-10 col-xs-12">
                                <textarea name="query" id="query" rows="8" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Please Verify You're Human
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Verification</label>
                            <div class="col-sm-10 col-xs-12">
                            <div class="g-recaptcha" data-theme="light" data-sitekey="6LebpyQTAAAAAEVmZ1L2-2iCYMJEMosyGkihMbAz"></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="button" class="btn btn-transparent btn-transparent-primary"><span class="fa fa-share"></span> Send Your Enquiry</button>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="title"><span class="typcn typcn-message"></span> Getting In Touch</h4>
                    </div>
                    <div class="panel-body">
                        <p>There are plenty of ways to get in touch with us, with our on-hand 24/7 tech support team here to help you. Feel free to get in touch by phone, email, or even send a letter to our offices.</p>
                        <p>We love feedback and use it to improve your every day experience using the application!</p>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item"><span class="fa fa-phone"></span>&nbsp;&nbsp;<strong>0123456789</strong></li>
                        <li class="list-group-item"><span class="typcn typcn-mail"></span>&nbsp;&nbsp;<strong>support@example.com</strong></li>
                        <li class="list-group-item"><span class="fa fa-map-marker"></span>&nbsp;&nbsp;<strong>123 Test Street</strong>, Nevada, NV018392</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection