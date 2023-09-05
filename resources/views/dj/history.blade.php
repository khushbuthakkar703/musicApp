@extends('layouts.djapp')
@section('content')
<title>SpinStatz | History</title>

<style>
    .list-group-1 {
        display: none;
    }

</style>
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content spin_videov2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <br>
                    <br>
                    
                </div>
                <div class="col-12 mt-5 pl-15 table_layout">
                    <div class="widget-body table-responsive">
                          <table class="col-md-12 mt-4 mb-4 mt-0 sm-plpr-0" role="table">
                <thead role="rowgroup">
                	<div class="row">
                    	<tr role="row">
                                <th width="5%"></th>
                                <th role="columnheader" >Artist Name</th>
                                <th role="columnheader" >Song Title</th>
                                <th role="columnheader" >Label</th>
                                <th role="columnheader" >Genre</th>
                                <th role="columnheader" >TW</th>
                                <th role="columnheader" >LW</th>
                                <th role="columnheader" >Total Spins</th>
                        </tr>
					</div>
				</thead>
                            <tbody style="border-bottom: 1px solid grey;" role="rowgroup" class="spin-details">
                            <?php $i = 0 ?>
                            @foreach($jsonrecords as $data)


                               @if(count($data['tw']) + count($data['lw']) > 0)
                                   <?php $i++ ?>
                                <tr>
                                    <td>{{ $i}}</td>
                                    <td>
                                    {{ $data['music']->artist_name }}
                                    <td>
                                        {{ $data['music']->song_title }}
                                    </td>
                                    <td>
                                        {{ $data['label'] }}
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
                               @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</main>  



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


