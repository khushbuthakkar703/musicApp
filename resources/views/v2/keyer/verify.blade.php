@extends('v2.layouts.layout')
@section('content')

    <style type="text/css">
        .table-hover thead tr:hover th, .table-hover tbody tr:hover td {
            background-color: #D1D119;
        }

        .dataTables_filter label {
            color: #fff;
            float: right;
        }

        .dataTables_length select, input {
            background-color: #3a4144;
            /*border: 0.2px solid #fff;*/
            padding: 3px;
        }

        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 3px !important;
        }
        .widget_search {
            margin-top: 35px;
            position: relative;
            margin-right: 12px;
        }
        #search_loader {
            position: absolute;
            right: 5px;
            top: 6px;
            font-size: 17px;
        }
        .paginate_enabled_next {
            float: right;
        }
    </style>
    <div class="container-fluid">
        @if($spin != null)
            <div class="row">
                <div class="widget widget-default widget-fluctuation">
                    <header class="widget-header">
                        Music Played by  {{$message['payload']['dj_name']}} on  <span style="color: red; font-weight: bold;" id="played_timestamp">{{$message['payload']['played_timestamp']}}</span>


                    </header>
                    <div class="widget-body">
                        <div class="col-lg-6">
                            <video width="90%" height="60%" controls autoplay="true">
                                <source src="http://spinstatz.org/records/{{$message['payload']['video_link']}}" type="video/webm">
                                Your browser does not support the video tag.
                            </video>

                        </div>
                        <div class="col-lg-6">
                            {{$mca->song_title}}

                            <audio controls="" preload="metadata" class="col-lg-12 col-sm-12 col-xs-12">
                                <source src="https://spinstatz.net/audio/{{$mca->audio}}" type="audio/mpeg">
                            </audio>


                            <a href="/review?id={{$spin->id}}&result=yes"> <input type="button" class="btn btn-default" onclick="yes()" value="Yes"></a>
                            <a href="/review?id={{$spin->id}}&result=no"> <input type="button" class="btn btn-transparent-danger" onclick="no()" value="No"></a>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="row">
                NO VIDEOS REMAINING
            </div>
    @endif


        <script>
            $(function(){
                var time = $("#played_timestamp").text()
                d = new Date(parseInt(time)*1000);
                $("#played_timestamp").html(d)

                $(document).keypress(function(){
                    if(event.which == 121){
                        window.location.href = window.location.origin + "/review?id="+{{$spin->id}}+"&result=yes"
                    }else if(event.which == 110){  //f
                        console.log("no");
                        window.location.href = window.location.origin + "/review?id="+{{$spin->id}}+"&result=no"
                    }
                });

            });

        </script>
@endsection
