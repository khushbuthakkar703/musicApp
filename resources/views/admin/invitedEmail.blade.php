@extends('layouts.djmanager')
<title>Invitations | SpinStatz</title>
@section('content')
    <div class="widget widget-default">
        @if($errors->any())
            <div class="alert">{{$errors->first()}}</div>
        @endif
        <header class="widget-header">
            Unaccepted Invitations
        </header>
        <div class="widget-body">
            <table class="table" id="unacceptedUsers">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Invited Date</th>
                    <th>Last reInvited Date</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notAcceptedInvitations as $invitation)
                    <tr id="row_{{$invitation->id}}">
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$invitation->email}}</td>
                        <td class="redable-date">{{$invitation->created_at}}</td>
                        <td class="redable-date">{{$invitation->updated_at}}</td>
                        <td class="text-right">
                            <button class="btn btn-transparent btn-xs inviteagain" value="{{$invitation->id}}"> Invite
                                Again
                            </button>

                            <button class="btn btn-xs btn-danger delete" value="{{$invitation->id}}"> Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="widget widget-default">
        <header class="widget-header">
            Accepted Invitations
        </header>
        <div class="widget-body">
            <table class="table accepted" id="acceptedUsers">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($acceptedInvitations as $invitation)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>
                            <a href="/dj/profile/{{$invitation->id}}">
                                {{$invitation->first_name}}
                                {{$invitation->last_name}}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="/js/jquery-1.12.3.min.js"></script>
<script src="/js/paginate.js"></script>
<script type="text/javascript">

    $(function () {
        $('#unacceptedUsers, #acceptedUsers').DataTable({
            "pagingType": "full_numbers",
            "searching": true,
            "ordering": false
        });
        // Selectors for future use
        $(document).on('click', ".inviteagain", function () {
            //$(".inviteagain").click(function(){
            console.log("clicked")
            var btn = $(this);

            $.ajax({
                type: "GET",
                url: "/reinvite/" + this.value,

                success: function (result) {
                    if (result.response == 'success')
                        btn.prop('disabled', true);
                    else
                        alert("Action failed")

                },
                error: function (result) {
                    alert("failed")
                }
            });
        });

        $(document).on('click', ".delete", function () {
            var btn = $(this);
            var id = this.value;

            $.ajax({
                type: "GET",
                url: "/invitation/delete/" + this.value,

                success: function (result) {
                    if (result.response == 'success') {
                        btn.prop('disabled', true)
                        //alert("Successfully deleted");
                        $('#row_' + id).remove();
                    } else {
                        //alert("de failed")
                    }

                },
                error: function (result) {
                    alert("failed")
                }
            });
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
    });

</script>

<script>
    $(document).ready(function () {
        document.getElementsByClassName("pending")[0].classList.add('active');
        dates = $('.redable-date');
        for (var i = 0; i < dates.length; i++) {
            dates[i].innerText = timeSince(new Date(dates[i].innerText)) + " ago"
        }


        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '',
                columns: [

                    {data: 'title'},
                    {data: 'created_at'},
                    {data: 'action'},

                ],
                "drawCallback": function () {
                    $('.editButton').on('click', function () {
                        $('#editFormId').attr('action', $(this).data('edit-link'));
                        level_id = $(this).data('level_id');

                        getEditData(level_id);
                    });
                    $('.confirm').on('click', function (e) {
                        return !!confirm($(this).data('confirm'));
                    });
                }
            });
        });

    });
    function getEditData(id) {
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log(id);
        $.get('/ajax-getLevel/' + id, function (data) {
            console.log(data);
            $('#levelTitle').val(data.title);
        });
    }


    function timeSince(date) {
        var seconds = Math.floor((new Date() - date) / 1000);
        var interval = Math.floor(seconds / 31536000);
        if (interval > 1) {
            return interval + " years";
        }
        interval = Math.floor(seconds / 2592000);
        if (interval > 1) {
            return interval + " months";
        }
        interval = Math.floor(seconds / 86400);
        if (interval > 1) {
            return interval + " days";
        }
        interval = Math.floor(seconds / 3600);
        if (interval > 1) {
            return interval + " hours";
        }
        interval = Math.floor(seconds / 60);
        if (interval > 1) {
            return interval + " minutes";
        }
        return Math.floor(seconds) + " seconds";
    }
</script>

