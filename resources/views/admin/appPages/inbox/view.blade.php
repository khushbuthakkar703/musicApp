@extends('layout.adminInbox')

@section('rightContent')
<div class="widget widget-default">
    <div class="widget-body">
        <div class="social-conversation">
            <div class="social-conversation-item social-conversation-item-right">
                <img src="{{ asset_segmented('img/user-1-profile.jpg') }}" alt="Tyrone G" class="social-conversation-item-image">
                <div class="social-conversation-item-ago text-primary">Just now</div>
                <div class="social-conversation-item-message">
                    <div class="social-conversation-item-message-from">Tyrone Gary</div>
                    <div class="social-conversation-item-message-content">How much money will this project make?</div>
                    <div class="social-conversation-item-message-timestamp">10:16AM - 17.05.2016</div>
                </div>
            </div>
            <div class="social-conversation-item">
                <img src="{{ asset_segmented('img/james-taylor.jpg') }}" alt="James T" class="social-conversation-item-image">
                <div class="social-conversation-item-ago">11m ago</div>
                <div class="social-conversation-item-message">
                    <div class="social-conversation-item-message-from">James Taylor</div>
                    <div class="social-conversation-item-message-content">I have been writing up the proposal for our latest project. It will be very lucrative</div>
                    <div class="social-conversation-item-message-timestamp">10:15AM - 17.05.2016</div>
                </div>
            </div>
            <div class="social-conversation-item social-conversation-item-right">
                <img src="{{ asset_segmented('img/user-1-profile.jpg') }}" alt="Tyrone G" class="social-conversation-item-image">
                <div class="social-conversation-item-ago">14h ago</div>
                <div class="social-conversation-item-message">
                    <div class="social-conversation-item-message-from">Tyrone Gary</div>
                    <div class="social-conversation-item-message-content">Hey James, what have you been working on today?</div>
                    <div class="social-conversation-item-message-timestamp">10:12AM - 17.05.2016</div>
                </div>
            </div>
        </div>
        <h4 class="text-left">Reply to James</h4>
        <textarea placeholder="Write your message here..." name="message_field" class="form-control" id="message_field" cols="30" rows="5"></textarea>
        <button type="button" class="btn btn-transparent btn-transparent-primary pull-right margin-top-5"><span class="fa fa-send"></span> Send</button>
    </div>
</div>
@endsection

@section('sidebarContent')
@include('layout.adminInbox.sidebar')
@endsection

@section('styles')
<link rel="stylesheet" href="/js/summernote.css">
@endsection

@section('scripts')
<script src="/js/summernote.min.js"></script>
<script src="/js/pages/compose-message.js"></script>
@endsection