@extends('layouts.djmanager')
@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-6 col-lg-4">

                <div class="widget widget-statistic widget-primary">

                    <header class="widget-statistic-header">Money Earned</header>

                    <div class="widget-statistic-body">

                        <span class="widget-statistic-value">${{$djManager->balance}}</span>

                        <button class="btn btn-sm btn-transparent-white" type="button">Withdraw Funds</button>

                        <span class="widget-statistic-icon fa fa-credit-card-alt"></span>

                    </div>

                </div>

            </div>
            <p><a href="/djmanager/invite" class="btn btn-lg btn-primary">Invite New DJs</a></p>
            <p>&nbsp;</p>
            <p><br>
                <br><br>
            </p>
            <p>&nbsp; </p>
            <div class="widget widget-default">

                <header class="widget-header">

                    Earn Your Money Here
                </header>

                <div class="widget-body">

                    <p>Below is a list of campaigns that your organization can accept to participate in and
                        campaigns that your organization has already agreed to support.your. To view campaign
                        details and DJ activity click on the campaign name.</p>

                </div>
            </div>
            <div class="row">
                @foreach($managerMusicCampaign as $musicCamp)
                    <div class="col-md-6 col-lg-4">
                        <div class="widget widget-statistic widget-default">
                            <header class="widget-statistic-header">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td width="58%"><a href="/view/campaign/{{$musicCamp->audio_id}}">{{$musicCamp->campaign_name}}</a>
                                        </td>
                                        <td width="42%" align="right">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td align="right"><strong>${{$musicCamp->spin_rate}}/SPIN<span
                                                                    style="text-align: right"></span></strong></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </header>
                            <div class="widget-statistic-body">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td width="21%" rowspan="4" valign="middle"><span
                                                    class="widget-statistic-value artist-image"><a href="#"><img
                                                            src="/{{$musicCamp->artwork}}"
                                                            alt="Img" height="75"
                                                            class="artist-image"></a></span></td>
                                        <td width="5%" rowspan="4">&nbsp;</td>
                                        <td width="74%" colspan="2">Artist: {{$musicCamp->first_name}} {{$musicCamp->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @php
                                                $genres = json_decode($musicCamp->genre)
                                            @endphp
                                            Genre:
                                            @foreach($genres as $genre)
                                                 &nbsp;{{App\MusicType::find($genre)->name}},
                                            @endforeach    

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">BPM: {{$musicCamp->bpm}}</td>
                                    </tr>
                                    @if($musicCamp->accepted == 0)
                                    <!-- <tr>
                                        <td><a href="/djmanagers/active_campaigns/action/{{$musicCamp->id}}/accept"
                                               class="btn btn-xs btn-white">Accept</a>
                                        </td>
                                        <td><a href="/djmanagers/active_campaigns/action/{{$musicCamp->id}}/decline" class="btn btn-xs btn-danger">Decline</a></td>
                                    </tr> -->
                                    @endif
                                    </tbody>
                                </table>
                                <span class="widget-statistic-icon fa fa-music"></span></div>
                        </div>
                    </div>
                @endforeach    
            </div>
        </div>


    </div>
@endsection

