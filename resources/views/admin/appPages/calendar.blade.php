@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-3" id="external-events">
            <div class="panel panel-default">
                <div class="panel-heading">Draggable Events</div>
                <div class="panel-body">
                    <div class="fc-event">My Event 1</div>
                    <div class="fc-event">My Event 2</div>
                    <div class="fc-event">My Event 3</div>
                    <div class="fc-event">My Event 4</div>
                    <div class="fc-event">My Event 5</div>
                    <input type="checkbox" data-icheck id="drop-remove" />
                    <label class="icheck-label" for="drop-remove">Remove event after drop</label>
                </div>
            </div>
            <p>
            </p>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="/css/fullcalendar.min.css">
@endsection
@section('scripts')
<script src="/js/moment.min.js"></script>
<script src="/js/jquery-ui.custom.min.js"></script>
<script src="/js/fullcalendar.min.js"></script>
<script src="/js/pages/calendar.js"></script>
@endsection