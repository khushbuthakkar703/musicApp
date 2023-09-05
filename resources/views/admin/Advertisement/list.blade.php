@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        @if($errors->any())
            <div class="alert">{{$errors->first()}}</div>
        @endif
        @if (session('alert'))
            <div class="alert alert-{{session('alert_class')}}">
                {{ session('alert') }}
            </div>
        @endif
        <header class="widget-header text-center">

            <a href="/newAdvertisement" class="pull-left btn btn-info" style="margin-left: 10px">New </a>
            <h4>Advertisement List</h4>
        </header>

        <div class="widget-body">
            <table class="table table-striped table-responsive" id="unacceptedUsers">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>No. of Days</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($adsLists as $list)
                    <tr id="row_{{$list->id}}">
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$list->title}}</td>
                        <td class="redable-date">{{$list->start_date}}</td>
                        <td class="redable-date">{{$list->end_date}}</td>
                        <td>{{$list->total_days}}</td>
                        <td>{{ ucfirst(strtolower($list->status))}}</td>
                        <td class="text-center">

                            <a href="/editAdvertisement/{{$list->id}}" title="Edit">
                                <i class="fa fa-edit"></i></a>&nbsp;
                            @if(isset($list->video_url) && $list->video_url !=null)
                                @php
                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/
                                ]{11})%i', $list->video_url, $match);
                                @endphp
                                | <a onclick="openAdVideoView('{{$match[1]}}')" style="cursor: pointer"> <i
                                            class="fa fa-video-camera"></i></a>&nbsp;
                                &nbsp;
                            @endif

                            @if(isset($list->image) && $list->image !=null)
                                | <a onclick="openAdImageView('{{$list->image}}')" style="cursor: pointer"> <i
                                            class="fa fa-image"></i></a>&nbsp;
                            @endif

                            @if($list->status == App\Advertisement::STATUS_APPROVE)
                                | <a href="/advertisementStatusUpdate/{{$list->id}}/{{App\Advertisement::STATUS_HOLD}}"
                                     title="Hold"
                                     class="text-warning">
                                    <i class="fa fa-pause"></i></a>
                            @endif

                            @if($list->status == App\Advertisement::STATUS_HOLD)
                                |
                                <a href="/advertisementStatusUpdate/{{$list->id}}/{{App\Advertisement::STATUS_APPROVE}}"
                                   title="Unhold"
                                   class="text-primary">
                                    <i class="fa fa-play"></i></a>
                            @endif

                            @if($list->status != App\Advertisement::STATUS_CANCEL)
                                |
                                <a href="/advertisementStatusUpdate/{{$list->id}}/{{App\Advertisement::STATUS_CANCEL}}"
                                   title="Cancel"
                                   class="text-danger">
                                    <i class="fa fa-times"></i></a>
                            @endif
                            @if($list->status == App\Advertisement::STATUS_PENDING)
                                |
                                <a href="/advertisementStatusUpdate/{{$list->id}}/{{App\Advertisement::STATUS_APPROVE}}"
                                   title="Approve"
                                   class="text-success">
                                    <i class="fa fa-check"></i></a>
                            @endif

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         style="margin-top: 80px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Image</h4>
                </div>
                <div class="modal-body">
                    <div id="displayData" class="text-center">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="adVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         style="margin-top: 80px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Video</h4>
                </div>
                <div class="modal-body">
                    <div id="displayVideoData" class="text-center">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="/js/jquery-1.12.3.min.js"></script>
<script src="/js/paginate.js"></script>
<script type="text/javascript">
    function openAdImageView(image) {
        $('#adVideoModal').modal('hide');
        $('#adModal').modal('show');
        $("#displayData").html("<img src=/" + image + " class='img-responsive'>");
    }

    function openAdVideoView(video) {
        $('#adModal').modal('hide');
        $('#adVideoModal').modal({show:true,backdrop: false});
        var url = "https://www.youtube.com/embed/" + video;
        $("#displayVideoData").html("<iframe width='100%' height='315' src=" + url + "  frameborder='0' id='vidio_src' allowfullscreen></iframe>");
    }
    $(function () {
        $('#unacceptedUsers').DataTable({
            "pagingType": "full_numbers",
            "searching": true,
            "ordering": false
        });


        var myTable = ".accepted";
        var myTableBody = myTable + " tbody";
        var myTableRows = myTableBody + " tr";
        var myTableColumn = myTable + " th";

        // Starting table state
        function initTable() {
            $(myTableBody).attr("data-pageSize", 15);
            $(myTableBody).attr("data-firstRecord", 0);
            $('#previous1').hide();
            $('#next1').show();

            // Increment the table width for sort icon support


            // Start the pagination
            paginate(parseInt($(myTableBody).attr("data-firstRecord"), 10),
                    parseInt($(myTableBody).attr("data-pageSize"), 10));
        }


        // Table sorting function
        function sortTable(table, column, order) {


        }

        // Heading click
        $(myTableColumn).click(function () {


            // Start the pagination
            paginate(parseInt($(myTableBody).attr("data-firstRecord"), 10),
                    parseInt($(myTableBody).attr("data-pageSize"), 10));
        });

        // Pager click
        $("a.paginate1").click(function (e) {
            e.preventDefault();
            var tableRows = $(myTableRows);
            var tmpRec = parseInt($(myTableBody).attr("data-firstRecord"), 10);
            var pageSize = parseInt($(myTableBody).attr("data-pageSize"), 10);

            // Define the new first record
            if ($(this).attr("id") == "next1") {
                tmpRec += pageSize;
            } else {
                tmpRec -= pageSize;
            }
            // The first record is < of 0 or > of total rows
            if (tmpRec < 0 || tmpRec > tableRows.length) return

            $(myTableBody).attr("data-firstRecord", tmpRec);
            paginate(tmpRec, pageSize);
        });

        // Paging function
        var paginate = function (start, size) {
            var tableRows = $(myTableRows);
            var end = start + size;
            // Hide all the rows
            tableRows.hide();
            // Show a reduced set of rows using a range of indices.
            tableRows.slice(start, end).show();
            // Show the pager
            $(".paginate1").show();
            // If the first row is visible hide prev
            if (tableRows.eq(0).is(":visible")) $('#previous1').hide();
            // If the last row is visible hide next
            if (tableRows.eq(tableRows.length - 1).is(":visible")) $('#next1').hide();
        }


        // Table starting state
        initTable();

        $(document).on('click','.close',function() {
            $('#vidio_src').removeAttr("src");
        });

        $(document).on('click','#close_btn',function() {
             $('#vidio_src').removeAttr("src");
        });
        
    });

</script>



