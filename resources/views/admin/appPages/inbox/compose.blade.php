@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-arrow-forward page-header-heading-icon"></span> Compose Message</h1>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="panel">
                <form>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="to_users">To</label>
                            <input type="text" name="to_users" id="to_users" class="form-control" placeholder="Who do you want to receive this message?">
                        </div>
                        <div class="form-group">
                            <label for="cc_users">CC</label>
                            <input type="text" name="cc_users" id="cc_users" class="form-control" placeholder="Who should be included in this conversation indirectly?">
                        </div>
                        <div class="form-group">
                            <label for="bcc_users">BCC</label>
                            <input type="text" name="bcc_users" id="bcc_users" class="form-control" placeholder="Who should this email be privately forwarded to?">
                        </div>
                        <div class="message-field">
                            <label>Message</label>
                            <div class="form-control" id="message-field"></div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <a href="{{ route('admin.appPages.inbox') }}" class="btn btn-transparent"><span class="fa fa-arrow-left"></span> Back To Inbox</a>
                        <button type="button" class="btn btn-transparent btn-transparent-primary"><span class="fa fa-share"></span> Send Message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            @include('layout.adminInbox.composeHelp')
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="/js/summernote.css">
@endsection

@section('scripts')
<script src="/js/summernote.min.js"></script>
<script src="/js/pages/compose-message.js"></script>
@endsection