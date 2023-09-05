@extends('layouts.monitor')
@section('content')
<style type="text/css">
    .table tr td
    {
      vertical-align: middle !important;
      text-align: center !important;
    }
</style>
<title>SpinStatz | Dashboard</title>
<div class="container-fluid">
     <div class="widget widget-default">
        <header class="widget-header">
          Top 10 Music Campaign audios
        </header>
        <div class="widget-body">
            <table class="table table-bordered table-responsive" >
                <thead>
                    <tr>
                        <td align="left" colspan="11">
                            <div style="display: block;" class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> By Genre <span class="caret"></span></button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                    @foreach($genres as $genre)
                                    <li><a href="{{$genre->id}}">{{$genre->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="2"><b>Rank</b></td>
                        <td  colspan="6"><b>Top 10 Perfoming Songs</b></td>
                        <td  colspan="3"><b>Spins</b></td>
                    </tr>
                    <tr>
                        <td ><b>TW</b></td>
                        <td ><b>LW</b></td>
                        <td  colspan="3"><b>Artist</b></td>
                        <td ><b>Song Title</b></td>
                        <td ><b>Label</b></td>
                        <td ><b>Genre</b></td>
                        <td ><b>YTD</b></td>
                        <td ><b>TW</b></td>
                        <td ><b>LW</b></td>
                    </tr>
                    <?php 
                    $colors=array('#FFFFFF','#ADCDF4','#6B6B6B','#383e41','#FFFFFF','#ADCDF4','#6B6B6B','#383e41','#FFFFFF','#ADCDF4');
                    $i=1; ?>
                    @foreach($topSongs as $topSong)
                        <tr class="" style="background-color:{{$colors[$i-1]}}; color: {{$colors[$i-1]=='#FFFFFF'?'#686767':'#FFFFFF'}};">
                            <td  valign="midd"><label class="label label-primary">{{$i}}</label></td>
                            <td ><label class="label label-dark">{{$topSong->lasweekRank}}</label></td>
                            <td>
                            @if($topSong->lasweekRank >= $i)
                            <span class="typcn typcn-arrow-sorted-up" style="color: #0EFC03"></span>
                            @else
                            <span class="typcn typcn-arrow-sorted-down" style="color: red"></span>
                            @endif    
                            
                            </td>
                            <td ><img width="50" height="50" src="{{asset($topSong->artwork)}}"></td>
                            <td style="font-size: 12px;">{{$topSong->artist_name}}</td>
                            <td style="font-size: 12px;">{{$topSong->song_title}}</td>
                            <td style="font-size: 12px;">{{$topSong->company_name}}</td>
                            <td style="font-size: 12px;">{{\App\MusicType::find(json_decode($topSong->genre)[0])->name}}</td>
                            <td style="font-size: 12px;">{{$topSong->total_spin}}</td>
                            <td bgcolor="#6B6B6B" ><a style="font-size: 12px;color:#FBBB00;" href="">{{$topSong->total}}</a></td>
                            <td bgcolor="#6B6B6B" ><a style="font-size: 12px;color:#FBBB00;" href="">{{$topSong->lastCount}}</a></td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
    <div class="widget widget-default">
        <header class="widget-header">
          Top 10 Music Campaign
        </header>
        <div class="widget-body">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Artist</th>
                        <th>Liks</th>
                        <th>Spin Rate</th>
                        <th>Spins</th>
                        <th>Start at</th>
                    </tr>
                </thead>
                <tbody>
               @foreach($campaign as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->campaign_name}}</td>
                        <td>{{$value->first_name}} {{$value->last_name}}</td>
                        <td>{{$value->likes}}</td>
                        <td>${{$value->spin_rate/2}}</td>
                        <td>{{$value->total_spin}}</td>
                        <td>@php 
                        echo explode(' ',$value->created_at)[0];
                        @endphp</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
