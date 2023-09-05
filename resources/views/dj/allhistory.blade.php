@extends('layouts.app')
@section('content')
<title>SpinStatz | History</title>

<style>
    .list-group-1 {
        display: none;
    }

</style>
    <div class="widget widget-default">

        <div class="widget-body table-responsive">
            <table border="1" align="center" class="table table-striped">
                <thead>

                <tr>
                    <th width="18%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Artist Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="18%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">DJ Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="12%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Club Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="10%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Club Capacity</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="21%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Song Title</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="16%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Label</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="16%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Genre</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>

                    <th width="12%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">TW</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="12%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">LW</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="8%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">TotalSpins</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>

                <tbody>
                <?php $i = 0 ?>
                @foreach($jsonrecords as $data)
                    <?php $i++ ?>
                    <tr>
                        
                        <td>
                        {{ $data['music']->artist_name }}
                        </td>
                        <td>
                        {{ $data['dj_name'] }}
                        </td>
                        <td>
                        {{ $data['club_name'] }}
                        </td>
                        <td>
                        {{ $data['club_capacity'] }}
                        </td>
                        <td>

                            {{ $data['music']->song_title }}
                        </td>
                        <td>
                            {{ $data['label'] }}
                        </td>
                        <td>
                            @php
                                $genres = json_decode($data['music']->genre);
                            @endphp
                            @foreach($genres as $genre)
                                     &nbsp;{{\App\MusicType::find($genre)->name}},
                            @endforeach    
                        </td>

                        <td>
                            @foreach($data['tw'] as $tw)
                                <code>{{ Carbon\Carbon::parse($tw->played_timestamp)->format('D h:i  a') }}</code><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($data['lw'] as $lw)
                                <code>{{ Carbon\Carbon::parse($lw->played_timestamp)->format('D h:i  a') }}</code><br>
                            @endforeach
                        </td>
                        <td>
                            {{ $data['played_count']  }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

    document.getElementsByClassName("history")[0].classList.add('active');
    tabcontent = document.getElementsByClassName("list-group");
    document.getElementById("details1").style.display = "block";

    function openDetails(id){
        
        for (var i = tabcontent.length-1; i >= 0; i--) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById("details"+ id).style.display = "block";
        //console.log("details opened", id)

    }

</script>

@endsection


