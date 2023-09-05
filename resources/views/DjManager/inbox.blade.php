@extends('layouts.djmanager')
@section('content')
<script src="/js/jquery-1.12.3.min.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <div class="panel">
                <div class="panel-body">
                    <ul class="inbox-sidebar-list">
                        <li class="inbox-sidebar-compose">
                            <a href="/djmanagers/messages/compose"
                               class="btn btn-block btn-lg btn-primary">Compose New</a>
                        </li>
                    </ul>
                    <ul class="inbox-sidebar-list">
                        <li class="inbox-sidebar-heading">
                            <h2 class="inbox-sidebar-heading-title">Folders</h2>
                        </li>
                        <li class="inbox-sidebar-item ">
                            <a href="javascript:void(0)" id="inbox"><span
                                        class="fa inbox-sidebar-icon fa-inbox"></span> Inbox</a>
                        </li>

                        <li class="inbox-sidebar-item">
                            <a href="javascript:void(0);" id="sent"><span class="fa inbox-sidebar-icon fa-paper-plane-o"></span>
                                Sent</a>
                        </li>


                    </ul>


                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="panel">

                <div class="panel-body">
                    <div>
                        <form class="form-inline pull-right">
                            <div class="form-group">
                                <input type="text" placeholder="Search Inbox..."
                                       class="form-control inbox-search-input">
                                <button class="btn btn-transparent btn-transparent-white">Search</button>
                            </div>
                        </form>
                        <h1 class="inbox-main-heading">Inbox
                            <small>{{count($inbox)}}</small>
                        </h1>
                    </div>
                    <form action="{{ route('djmanager.message.delete') }}" method="post">
            {{ csrf_field() }}
                    <div class="inbox-actions">
                        <button type="button" class="btn btn-transparent btn-transparent-white btn-sm"><span
                                    class="fa fa-refresh"></span> Refresh
                        </button>
                        <button type="submit" class="btn btn-transparent btn-transparent-danger btn-sm"><span
                                    class="fa fa-trash"></span> Delete
                        </button>
                        <div class="btn-group pull-right">
                            <button class="btn btn-transparent btn-transparent-white btn-sm"><i
                                        class="fa fa-arrow-left"></i></button>
                            <button class="btn btn-transparent btn-transparent-white btn-sm"><i
                                        class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <table class="inbox table table-inbox table-vertical-align-middle">
                    <thead>
                    <tr>
                        <th></th>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Sent</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($inbox as $row)
                    <tr>
                        <td>
                            <input value="{{$row->id}}" name="messageIds[]" type="checkbox" class="table-row-checkbox">
                        </td>
                        <td>
                        @if($row->dj_name==NULL)
                        Admin
                        @else
                        {{$row->dj_name}}
                        @endif
                        </td>
                        <td>Custom Message</td>
                        <td>{{$row->message}}</td>
                        <td>
                            <small class="text-muted">{{$row->updated_at}}</small>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <table style="display: none;" class="table table-inbox table-vertical-align-middle sent">
                    <thead>
                    <tr>
                        <th></th>
                        <th>To</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Sent</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($sent as $row)
                    <tr>
                        <td>
                            <input value="{{$row->id}}" name="messageIds[]" type="checkbox" class="table-row-checkbox">
                        </td>
                        <td>
                        @if($row->dj_name==NULL)
                        Admin
                        @else
                        {{$row->dj_name}}
                        @endif
                        </td>
                        <td>Custom Message</td>
                        <td>{{$row->message}}</td>
                        <td>
                            <small class="text-muted">{{$row->updated_at}}</small>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementsByClassName("inbox1")[0].classList.add('active');
</script>
@endsection
@section('custom_js')
<script type="text/javascript">
    $('#inbox').click(function(){
      $('.sent').css('display','none');
      $('.inbox').css('display','block');
      $('.inbox').css('display','inline-table')  
    });
    $('#sent').click(function(){
      $('.sent').css('display','block');
      $('.sent').css('display','inline-table')
      $('.inbox').css('display','none');

    });
</script>
@endsection