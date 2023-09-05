<div class="row">
    @foreach($campaigns as $campaign)
        <div class="col-md-6 col-lg-4">
            <div class="widget widget-default widget-fluctuation">
                <header class="widget-header">
                    <a href="/huddle/{{$campaign->campaign_id}}" style="overflow:hidden;">{{$campaign->song_title}}</a>
                    <span class="pull-right">${{$campaign->spin_rate/2}}/Spin</span>
                </header>
                <div class="widget-body">
                    <section class="widget-fluctuation-period col-lg-4 col-sm-4 col-xs-4 col-md-6">
                        <div class="widget-statistic-icon">
                            <!-- <img
                                    src="/{{$campaign->artwork}}"
                                    alt="{{$campaign->song_title}}" height="75"
                                    class="artist-image"> -->
                            <div style="padding-left: 0px;" class="audio-player-image col-lg-12 col-sm-12 col-xs-12">
                                <img src="/{{$campaign->artwork}}" height="80" width="80" alt="{{$campaign->song_title}}">
                            </div>
                           <a  class="fa fa-play music-btn" href="javascript:void(0);" onclick="play(this);">
                               <audio preload="metadata" class='player_audio' src="{{asset('audio/'.$campaign->audio)}}"></audio>
                           </a>


                            <audio style="visibility:hidden;"  controls preload="metadata" controlsList="nodownload novolume" class="col-lg-12 col-sm-12 col-xs-12">
                                <source src="/audio/{{$campaign->audio}}" type="audio/mpeg">
                            </audio>

                        </div>
                    </section>
                    <section class="widget-description col-lg-8 col-sm-8 col-xs-8 col-md-6">
                        <div style="list-style: none;">
                            <li>
                                <div style="overflow: hidden; height: 1.5em;">
                                    Artist: &nbsp;{{$campaign->artist_name}}
                                </div>
                            </li>
                        </div>
                    </section>
                </div>
                <header class="widget-header">
                    <span class="widget-statistic-description">Campaign Start: {{$campaign->created_at->todatestring()}}
                        &nbsp;</span>
                    <span class="label label-success pull-right"><strong>Total Spins:&nbsp</strong>{{$campaign->total_spin}}</span>
                </header>
            </div>
        </div>
    @endforeach
</div>

<div class="row pagination-lg">
    {{ $campaigns->links() }}
</div>
