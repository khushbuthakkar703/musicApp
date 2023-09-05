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


            <div class="widget widget-default">

                <header class="widget-header">

                    Spin History</header>



            <table  id="viewAllMatches" class="table">
                <thead>
                    <tr>
                    <th>S.N</th>
                    <th>DJ Name</th>
                    <th>Music Title</th>
                    <th>Genre</th>
                    <th>Played Time</th>
                    <th>Message</th>
                    <th>Video</th>
                </tr>
                </thead>

                <tbody>


                @foreach($jsonrecords as $djrecords)
                    
                    <tr>
                        <td >{{$loop->iteration}}</td>
                            <td >{{$djrecords['playedByDj'] or 'username error'}}</td>
                            <td >{{$djrecords['music']->song_title or 'Not added'}}</td>
                            <td>{{$djrecords['music']->genre or 'Not added'}}</td>
                            <td class="hidden-xs hidden-sm" width="150">{{$djrecords['played_time'] or 'Not added'}}</td>
                            <td class="hidden-xs hidden-sm" width="150">{{$djrecords['message']}}
                            <td>
                             <a target="_blank" href="/records/{{$djrecords['video']}}">{{$djrecords['video']}} </a>
                            </td
                        </td>

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
