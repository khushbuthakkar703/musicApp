@php($currentUser = auth()->user())
@extends('layouts.djmanager')
<style type="text/css">
    .dataTables_filter label {
        color: #fff;
    }
    .dataTables_length select, input {
        background-color: #3a4144;
        /*border: 0.2px solid #fff;*/
        padding: 3px;
    }
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 3px !important;
    }
</style>
@section('content')
    <title>SpinStatz | Dashboard</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="widget widget-statistic widget-primary">
                    <header class="widget-statistic-header">Money Earned</header>
                    <div class="widget-statistic-body">
                        <span class="widget-statistic-value"><i class="fa fa-usd"></i>{{$djManager->balance}}</span>
                        <button class="btn btn-sm btn-transparent-white" type="button">Withdraw Funds</button>
                        <span class="widget-statistic-icon fa fa-credit-card-alt"></span>
                    </div>
                </div>
            </div>
            <p><a href="/djmanager/invite" class="btn btn-lg btn-primary">Invite New DJs</a></p>
            <p>&nbsp;</p>
        </div>
        <div class="row">
            <div class="widget widget-default">
                <header class="widget-header">
                    Spin History
                </header><br>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="widget widget-default">
                            <header class="widget-header">
                                Daily Activity
                            </header>
                            <div class="widget-body">
                                <canvas id="chart-example-bar"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="widget widget-default">
                            <header class="widget-header">
                                Monthly Activity
                            </header>
                            <div class="widget-body">
                                <canvas id="chart-example-line"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="widget widget-default">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td>
                        <header class="widget-header">
                            Managed DJs
                      </header>
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
           <div class="widget-body">
			<table class="table" text-align="center" id="tblDjList">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>DJ Name</th>
                    <th class="hidden-xs hidden-sm">City</th>
                    <th class="hidden-xs hidden-sm">State</th>
                    <th class="hidden-xs">Email</th>
                    <th align="center" class="hidden-xs hidden-sm">Club</th>
                    <th>Spins LW</th>
                    <th>/</th>
                    <th>TW</th>
                    <th>Phone Number</th>
                     <th class="hidden-xs">&nbsp;</th>
                    <th style="text-align: left">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jsonrecords as $djrecords)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td align="left"><a href="/djmanager/djspinreport/{{$djrecords['dj']->id or 'id error'}}/"
                                            target="_blank">{{$djrecords['dj']->dj_name or 'username error'}}</a>
                        </td>
                        <td class="hidden-xs hidden-sm">{{$djrecords['dj']->city}}</td>
                        <td class="hidden-xs hidden-sm">{{$djrecords['dj']->state}}</td>
                        <td class="hidden-xs">{{App\User::find($djrecords['dj']['user_id'])['email']}}</td>
                        <td class="hidden-xs hidden-sm">
                        @if($djrecords['dj']->type == 'mobile')
                            Mobile Dj
                        @else
                            @php
                                $club = App\Club::where('dj_id',$djrecords['dj']->id)
                                    ->select('name')
                                    ->first()
                            @endphp

                            {{$club['name'] or 'Club Not Added'}}
                         @endif
                        </td>
                        <td align="center" class=""><a
                                    href="/djmanager/{{$djrecords['dj']->user_id or 'useid lastweek error'}}/weekly/1">{{$djrecords['last_week_total'] or 'lastweek error'}}</a>
                        </td>
                        <td>&nbsp;</td>
                        <td align="center" class="">
                            <a href="/djmanager/{{$djrecords['dj']->user_id or 'userid thisweek'}}/weekly/0">{{$djrecords['weektotal']  or 'thisweek error'}}</a>
                        </td>
                        <td width="92" align="right"
                            class="">{{$djrecords['dj']->phone_number or 'N/A'}}
                        </td>
                        <td width="67" align="right" class="hidden-xs hidden-sm">
                            <a href="/djmanager/dj/edit/{{$djrecords['dj']->id or 'edit manager error'}}">
                                <button class="btn btn-transparent btn-xs">
                                    <span class="fa fa-pencil"></span>
                                    <span class="hidden-xs hidden-sm hidden-md">Edit</span>
                                </button>
                            </a>
                        </td>
                        <td>
                            @if(App\User::find($djrecords['dj']->user_id)['blocked'] =='no')
                                <button class="btn btn-success btn-xs verified" value="{{$djrecords['dj']->id}}"><span
                                            class="fa fa-check"></span>Verified
                                </button>
                            @elseif(App\User::find($djrecords['dj']->user_id)['blocked'] =='yes')
                                <button class="btn btn-transparent btn-transparent-danger btn-xs not-verified"
                                        value="{{$djrecords['dj']->id}}"><span class="fa fa-eject"></span> Not Verified
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
			   </div>
	      </div>
        </div>
    </div>

    @include('CommonComponents.adPopUp')

    <script type="text/javascript">
        document.getElementsByClassName("dashboard")[0].classList.add('active');
    </script>
@endsection
<script>window.jQuery || document.write('<script src="/js/jquery-1.12.3.min.js"><\/script>')</script>
<script src="/js/manager/graph.js"></script>
<!-- <script src="/js/paginate.js"></script> -->
<script type="text/javascript">
    $(function () {
        var table = $('#tblDjList').DataTable({
            "pagingType": "full_numbers",
            "searching": true,
            "ordering": true,
            "sScrollY": true,
            // "bScrollCollapse": true,
            "columnDefs": [
                {"width": "20px", "targets": [5, 6]}
            ],
            "columnDefs": [
                {"width": "20px", "targets": [4]}
            ],
            // "columnDefs": [
            //     { "width": "15%", "targets": [9] }
            //   ]
        });
        $('select').change(function () {
            table.columns.adjust().draw();
        });
        $(document).on('click', ".verified", function () {
            console.log(this.value, "verified clicked")
            var btn = $(this);
            $.ajax({
                type: "GET",
                url: "/djmanager/manager/block/" + this.value,
                success: function (result) {
                    if (result.response == 'success') {
                        btn.prop('disabled', true)
                        alert("Successfully unVerified")
                    }
                    else
                        alert("Unverification failed")
                },
                error: function (result) {
                    alert("failed")
                }
            });
        });
        $(document).on('click', ".not-verified", function () {
            console.log(this.value, "not verified clicked")
            var btn = $(this);
            $.ajax({
                type: "GET",
                url: "/djmanager/manager/unblock/" + this.value,
                success: function (result) {
                    if (result.response == 'success') {
                        btn.prop('disabled', true)
                        alert("Successfully Verified")
                    } else {
                        alert("Verification failed")
                    }
                },
                error: function (result) {
                    alert("failed")
                }
            });
        });
    });
</script>
