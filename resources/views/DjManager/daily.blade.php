@extends('layouts.djmanager')
<title>SpinStatz | {{App\User::find($dj)->dj()->first()->dj_name}}</title>
@section('content')
<div class="row">
    <div class="widget widget-default">
        <header class="widget-header">
            Daily Statistics of {{App\User::find($dj)->dj()->first()->dj_name}}</header>
        <div class="widget-body">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td width="48%">See what songs and how often your DJs play music.</td>
                    <td width="52%" align="right" valign="bottom">  <ul class="pager">

                            <span class="fc-icon fc-icon-left-single-arrow"></span>
                            <span class="fc-icon fc-icon-right-single-arrow"></span>

                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"> <ul class="pager">

                            <li class="previous"><a href="/djmanager/{{$dj}}/weekly/{{$week+1}}"><span aria-hidden="true">&larr;</span> Older</a>{{Carbon\Carbon::parse($startDate)->format('M d')}} - {{Carbon\Carbon::parse($endDate)->format('M d')}}</li>

                            <li class="next"><a href="/djmanager/{{$dj}}/weekly/{{$week-1}}">Newer <span aria-hidden="true">&rarr;</span></a></li>

                        </ul></td>
                </tr>
                </tbody>
            </table>
            <table width="731" height="" class="table table-bordered table-striped"> <thead> <tr> <th width="28"></th>
                    <th width="39"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Song Name</td>
                            </tr>
                            </tbody>
                        </table></th>
                    <th width="39" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Genre</td>
                            </tr>
                            </tbody>
                        </table></th>
                    <th width="65">Sunday</th> <th width="69">Monday</th> <th width="72">Tuesday</th> <th width="95">Wednesday</th>
                    <th width="78">Thursday</th>
                    <th width="57">Friday</th>
                    <th width="75">Saturday</th>
                    <th width="48">Total</th>
                </tr>
                </thead> 
                <tbody> 
                    @php
                        $sunCount = 0;
                        $monCount = 0;
                        $tueCount = 0;
                        $wedCount = 0;
                        $thurCount = 0;
                        $friCount = 0;
                        $satCount = 0;
                    @endphp
                    @foreach($identifiedMusics as $key=>$identifiedMusic)
                        @php($musicCount = 0)
                    
                        <tr> 
                            <td class="text-nowrap" scope="row">1</td>
                            <td class="text-nowrap" scope="row">{{App\MusicCampaignAudio::where('id',$key)->first()->song_title}}</td>
                            <td class="text-nowrap" scope="row">
                                @php($gen = json_decode(App\MusicCampaignAudio::where('id',$key)->first()->genre))
                                @foreach($gen as $g)
                                    {{App\MusicType::find($g)->name}}
                                @endforeach
                            </td>
                                <td>
                                    @php($identifiedMusic = json_decode($identifiedMusic))
                                    @if(array_key_exists('Sunday', $identifiedMusic))
                                        @foreach($identifiedMusic->Sunday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($sunCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('Monday', $identifiedMusic))
                                        @foreach($identifiedMusic->Monday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($monCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('Tuesday', $identifiedMusic))
                                        @foreach($identifiedMusic->Tuesday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($tueCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('Wednesday', $identifiedMusic))
                                        @foreach($identifiedMusic->Wednesday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($wedCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('Thursday', $identifiedMusic))
                                        @foreach($identifiedMusic->Thursday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($thurCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('Friday', $identifiedMusic))
                                        @foreach($identifiedMusic->Friday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($friCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('Saturday', $identifiedMusic))
                                        @foreach($identifiedMusic->Saturday as $music)
                                            <code>{{Carbon\Carbon::parse($music->played_timestamp)->format('g:i a')}}</code><br>
                                            @php($satCount++)
                                            @php($musicCount++)
                                        @endforeach    
                                    @endif
                                </td>
                                <td valign="middle">{{$musicCount++}}</td>
                        </tr>
                    @endforeach    
                <tr> <td height="52" class="text-nowrap" scope="row">&nbsp;</td>
                    <td height="52" colspan="2" class="text-nowrap" scope="row"><strong>Totals</strong></td>
                    <td>{{$sunCount}}</td>
                    <td>{{$monCount}}</td>
                    <td>{{$tueCount}}</td>
                    <td>{{$wedCount}}</td>
                    <td>{{$thurCount}}</td>
                    <td>{{$friCount}}</td>
                    <td>{{$satCount}}</td>
                    <td>{{$sunCount + $monCount + $tueCount + $wedCount + $thurCount + $friCount + $satCount}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    @endsection