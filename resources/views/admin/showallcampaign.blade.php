@extends('layouts.admin')
@section('content')
    <style>
        tbody {
            color: black;
        }
        #viewAllMatches{
            color: white;
        }
    </style>
    <div class="container-fluid">

        <div class="row">


            <div class="widget-body">

              <header class="widget-header">

                    Spin History</header>

            <table  id="viewAllMatches" class="table table-striped table-responsive">
                <thead>
                    <tr>
                    <th width="10" style="text-align: left">S.N</th>
                    <th>Song Title</th>
                    <th>Contact Person</th>
                    <th width="75">Phone</th>
                    <th>Campaign Balance</th>
                    <th>Campaign Name</th>
                  </tr>
                </thead>

                <tbody>


                @foreach($campaigns as $campaign)
                    
                    <tr>

                        <td style="color: #FFFFFF" >{{$loop->iteration}}</td>
                        <td style="color: #FFFFFF" >{{$campaign->song_title}}</td>
                        <td style="color: #FFFFFF" >{{$campaign->first_name." ".$campaign->last_name}}</td>
                        <td style="color: #FFFFFF" >{{$campaign->phone}}</td>
                        <td style="color: #FFFFFF">{{$campaign->campaign_balance}}</td>
                        <td style="color: #FFFFFF"></td>
                    </tr>
                @endforeach
                </tbody>

            </table>


        </div>
    </div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#viewAllMatches').DataTable();
    } );
</script>
@endsection
