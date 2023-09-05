@extends('layouts.monitor')
@section('content')
{{-- <style type="text/css">
    .table tr td
    {
      vertical-align: middle !important;
      text-align: center !important;
    }
</style> --}}
<title>SpinStatz | Dashboard</title>
<div class="container-fluid">
     <div class="widget widget-default">
        <header class="widget-header">
          Dj Spin Detail
        </header>
        <div class="widget-body">
                   <table border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="" rowspan="6"><span class="img-responsive"><img  src="{{asset($music->artwork)}}" width="200" height="200" /><BR><strong>{{$music->song_title}} - {{$music->artist_name}}</strong></span></td>
      <td width="24%">&nbsp;</td>
      <td width="38%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="left">Label Name:</td>
      <td align="left">{{$music->company_name}}</td>
    </tr>
    <tr>
      <td align="left">Artist Website:</td>
      <td align="left"><a href="{{$music->artist_website}}" target="_blank">{{$music->artist_website}}</a></td>
    </tr>
    <tr>
      <td align="left">Video Link:</td>
      <td align="left"><a target="_blank" href="{{$music->youtube_feature}}">{{$music->youtube_feature}}</a></td>
    </tr>
  </tbody>
</table>
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  
                  <tr>
                    <td colspan="2" align="center"> <ul class="pager">

                        <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a>
                        <?php echo $sunday_date->format('F').' '.$sunday_date->format('d').'-'.$saturday_date->format('F').' '.$saturday_date->format('d')?>
                        </li>

                        <li class="next disabled"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>

                      </ul></td>
                  </tr>
                </tbody>
            </table>
                  <table  class="table table-bordered table-striped"> <thead> <tr> <th></th>
                    <th><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td align="center">DJ Name</td>
                        </tr>
                      </tbody>
                    </table></th>
                      <th width="19">Country</th>
                    <th width="39" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td align="center">City</td>
                        </tr>
                      </tbody>
                    </table></th> 
                    <th width="65"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td>Sunday</td>
                        </tr>
                      </tbody>
                    </table></th> <th width="69">Monday</th> <th width="72">Tuesday</th> <th width="95">Wednesday</th>
                    <th width="78">Thursday</th>
                    <th width="57">Friday</th>
                    <th width="75" align="center">Saturday</th>
                    <th width="48">Total</th>
                    </tr> 
                    </thead> 
                    <tbody> 
                    @php 
                     $i=1;
                    @endphp
                    @foreach($jsonrecords as $row)
                    <tr> 
                      <td>{{$i}}</td>
                          <td>{{$row['dj']->dj_name}}</td>
                          <td>{{$row['dj']->country}}</td>
                          <td>{{$row['dj']->city}}</td> 
                          <td>@foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                              @if($day->Sunday!=null)
                                <code>{{$day->Sunday}}</code><br>
                              @endif  
                            @endif
                          @endforeach</td>
                          <td>@foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                              @if($day->Monday!=null)
                                <code>{{$day->Monday}}</code><br>
                              @endif  
                            @endif
                          @endforeach</td>
                          <td>
                          @foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                              @if($day->Tuesday!=null)
                                <code>{{$day->Tuesday}}</code><br>
                              @endif
                            @endif  
                          @endforeach
                          </td>
                          <td>
                          @foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                               @if($day->Wednesday!=null) 
                                <code>{{$day->Wednesday}}</code><br>
                                @endif
                            @endif
                          @endforeach
                          </td>
                          <td>
                            @foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                               @if($day->Thursday!=null) 
                                <code>{{$day->Thursday}}</code><br>
                                @endif
                            @endif
                          @endforeach
                          </td>
                          <td>
                          @foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                               @if($day->Friday!=null) 
                                <code>{{$day->Friday}}</code><br>
                                @endif
                            @endif
                          @endforeach
                          </td>
                          <td>
                          @foreach($row['time_array'] as $day)
                            @if($day->dj_id==$row['dj']->dj_id)
                               @if($day->Saturday!=null) 
                                <code>{{$day->Saturday}}</code><br>
                                @endif
                            @endif
                          @endforeach
                          </td>
                          <td valign="middle">{{count($row['time_array'])}}</td>
                      </tr>
                      @php $i++ @endphp
                     @endforeach 
                    </tbody> 
                  </table>
        </div>
    </div>
   

</div>
@endsection
