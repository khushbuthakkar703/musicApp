@extends('layouts.djapp')
@section('content')
    @php
        $currentUser = auth()->user();
        $djdata = App\Dj::where('user_id',$currentUser->id)->first();
    @endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/wavesurfer.js"></script>
<title>SpinStatz | {{$musicCampaign->campaign_name}}</title>

<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content single_song">
    <div class="replaceElementHandler">
        <div class="close-popup">
            <i class="fa fa-close"></i> Close
        </div>
        <div class="hero-background-user" style="position: relative;   background-size: cover !important; background-position: center center !important; background: url('{{ url($musicCampaignAudio->artwork)}}')" >
            <div class="content single_cutom">
                <!-- Spinstatz DJ Dashboard Heading -->
                <div class="mdl-grid mb-3">
                    <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
                        
                        <h3 id="user-dashboard ml-unset"> {{$musicCampaignAudio->song_title}}</h3>
                        <p id="user-dashboard ml-unset" class="song_sub">{{$musicCampaignAudio->artist_name}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content pt-0">
            <div class="mdl-grid mb-3 Song_main_title">
                <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
                    <h3 id="user-dashboard ml-unset"> REMAINING SPINS:
                        @if($musicCampaign->spin_rate !=0)
                        {{floor($musicCampaign->campaign_balance/$musicCampaign->spin_rate)}}
                        @else
                        0
                        @endif

                    </h3>
                    <small style="color: white">This shows the amount of paying spins remaining on this song.</small>
                    <!-- <p style="font-weight: bold; font-size:small; color:grey">{{$musicCampaign->campaign_name}}</p> -->
                </div>
            </div>
            <div class="card-deck mt-4 col-12 song_detils">
                <div class="campaign-details-section col-md-12">
                    <div class="card">
                        <div class="card-body m-3 " style="color:rgb(132, 255, 255);">
                            <div class="d-flex col-md-12 pl-0pr-0">
                                @if($musicCampaignAudio!=null)
                                    
                                    <div class="col-md-2">
                                        <a href="#" class="btn song_detils_spin_btn" role="button">
                                            @if($djdata->type != "online")
                                            ${{App\Helpers\Settings::get_dj_spin_rate($djdata->star,$musicCampaign->spin_rate)}}
                                            @else
                                                {{$musicCampaign->spin_rate > 0 ? 1 : 0}}
                                            @endif
                                            /Spin
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <spna class="detils_title">Genre</spna> <br>
                                        <span class="detils_sub_title">
                                            {{App\MusicType::find(json_decode($musicCampaignAudio->genre)[0])->name}}
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <spna class="detils_title">BPM</spna> <br>
                                        <span class="detils_sub_title"> {{$musicCampaign->bpm}}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <spna class="detils_title">Total Spins</spna> <br>
                                        <span class="detils_sub_title">{{$musicCampaign->total_spin}}</span>
                                    </div>
                                    <div class="col-md-2">
                                    </div>  
                                    <div class="col-md-2 text_right" >
                                        <i class="material-icons ml-2 mt-1" style="color:rgb(132, 255, 255); font-size:20px">
                                            playlist_add
                                        </i><br>
                                        <i class="fa fa-thumbs-o-up" aria-hidden="true" data-toggle="tooltip" title="Click to like" @if($reaction == 1) style="color: green" disabled @endif> </i>
                                        <span style="color: #FFF;" id="like">{{$musicCampaign->likes}}</span>
                                        <i class="fa fa-thumbs-o-down" aria-hidden="true" data-toggle="tooltip" title="Click to dislike" @if($reaction == 0) style="color: red" disabled @endif></i>
                                        <span id="dislike">{{$musicCampaign->dislikes}}</span>
                                        
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="hr_line">
                        <div class="col-md-12">
                            <div class="waveSongDetailsHandler">
                                <div><span onclick="togglePlaying1()">
                                    <i id="audioControl1" action="play" class="fas playPauseToggleHandle single fa-spinner fa-spin" style="top: 14px;left: -139px; font-size:large"></i>
                                </span></div>
                                <div id="audioWave"></div>
                                <div class="single-time-handler">
                                    <span class="ml-20 changeCurrentTime1" style="color: white;" id="current-time">00:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="page-header-heading text-justify" value="{{$musicCampaignAudio->id}}" style="display: none;">
                        <span class="typcn typcn-home page-header-heading-icon">
                        </span>
                {{$musicCampaignAudio->song_title}}
            </h2>
            <div class="total_spin_graph">
                <div class="col-12 mt-5 sm-plpr-0">
                   <div class="widget widget-default">
                        <input type="hidden" id="campaign_id" value="{{$musicCampaign->id}}">
                        <div class="widget-body">
                            <canvas id="graphmonthlyspin" height="75px"></canvas> 
                        </div>
                    </div>
                </div>
            </div>  
            <!-- FILTERS START -->
            <div class="">
                <div class="col-12 mt-5 sm-plpr-0 text_right">
                    @if(!$isEligible)
                        <span class="btn-danger"><b>THIS SONG IS NOT PAYING IN YOUR AREA BUT YOU CAN EARN POINTS THAT CAN BE USED TO MAKE SITE PURCHASES AND INCREASE YOUR DJ RATING IF YOU JOIN AND PLAY THE MUSIC IN YOUR VENUE.</b></span><br>
                    @endif

                    @if($hasJoined)
                        @if(!$isEligible)
                            <button class="song_detils_spin_btn call_ajax"  value="Leave Campaign" link="/dj/campaign/leave/{{$musicCampaign->id}}">Leave Campaign</button>
                        @elseif($canleave)
                    <button class="song_detils_spin_btn call_ajax"  value="Leave Campaign" link="/dj/campaign/leave/{{$musicCampaign->id}}">Leave Campaign</button>

                        @else
                            <a href="">
                                <input class="song_detils_spin_btn" type="button"  value="You Must Spin Twice to Leave Campaign" data-toggle="tooltip" title="You Must Spin Twice to Leave Campaign" disabled>
                            </a>
                        @endif
                    @else
                        <input type="checkbox" class="checkbox1" id="remember_me_1">
                        By checking I agree to play the music in an attempt to help this campaign be successful. I have listened to the music and it is a song that I am willing to play in my venue in an attempt to make it popular. I also confirm that I must play this song a minimum of two times within THREE (3) WEEKS. <span style="color: #FF0005">(All joined campaigns must have their two (2) spins before withdrawal requests will be approved.)</span><br><br>
                        <button class="song_detils_spin_btn join call_ajax"  value="Join Campaign" disabled link="/dj/campaign/accept/{{$musicCampaign->id}}">Join Campaign</button>


                    @endif
                </div>
            </div>

            <div class="card-deck mb-40 col-12 video_plyer">
                <!-- MONEY EARNED CARD -->
                @if($musicCampaignAudio!=null)
                    @if($musicCampaignAudio->youtube_feature != null)
                        @php
                            $url = $musicCampaignAudio->youtube_feature;
                             preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                             $youtubeId = $match[1];
                        @endphp
                        <div class="card mr-0 col-md-5">
                            <iframe width="350" height="200" src="https://www.youtube.com/embed/{{$youtubeId}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                            </iframe>
                        </div>
                    @endif
                @endif

                <div class="col-md-7">
                    <div class="download-audios">
                        <ul>
                            @if($hasJoined)

                            <li class="profile-resource-list-item">
                                <i class="fa fa-music" aria-hidden="true"></i>&nbsp{{$musicCampaignAudio->song_title}}
                                <a href="/music/download/{{$musicCampaignAudio->id}}">
                                    <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                                class="fa fa-download"> </span>
                                        Download
                                    </button>
                                </a>
                            </li>
                            @if($instrumental!=null)
                                <li class="profile-resource-list-item">
                                    <i class="fa fa-music" aria-hidden="true"></i>&nbsp Instrumental
                                    <a href="/{{$instrumental->song_path}}" download="{{$musicCampaignAudio->song_title}}_instrumental">
                                        <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                                    class="fa fa-download"> </span>
                                            Download
                                        </button>
                                    </a>
                                </li>
                            @endif
                            @if($radio!=null)
                                <li class="profile-resource-list-item">
                                    <i class="fa fa-music" aria-hidden="true"></i>&nbsp Radio
                                    <a href="/{{$radio->song_path}}" download ="{{$musicCampaignAudio->song_title}}_radio">
                                        <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                                    class="fa fa-download"> </span>
                                            Download
                                        </button>
                                    </a>
                                </li>
                            @endif
                            @if($acappella!=null)
                                <li class="profile-resource-list-item">
                                    <i class="fa fa-music" aria-hidden="true"></i>&nbsp Acappella
                                    <a href="/{{$acappella->song_path}}_acappela">
                                        <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                                    class="fa fa-download" download ="{{$musicCampaignAudio->song_title}}"> </span>
                                            Download
                                        </button>
                                    </a>
                                </li>
                            @endif

                        @endif
                        </ul>
                    </div>
                </div>

            </div>

        </div> 
        <script type="text/javascript">
            $(".call_ajax").on('click', function (){
                const url_to_req = $(this).attr('link');
                button_attr = this
                jQuery.ajax({
                    url: url_to_req,
                    type: 'get',
                    success: function (response) {
                        if (response['status'] === 200){
                            alert(response['message'])
                            $(button_attr).text(response['message'])
                        }else if (response['status'] === 300){
                            alert(response['message'])
                            $(button_attr).text(response['message'])
                        }
                    }
                });

            })

            $(".fa-thumbs-o-up").on('click',function(){
                id = $(".page-header-heading")[0].attributes.value.value
                url = "/dj/reaction/"+id+"/"+1;
                console.log(url);
                jQuery.ajax({
                    url: url,
                    type: 'get',
                    success: function (response) {
                        // Perform operation on the return value
                        $("#like").html(response.likes)
                        $("#dislike").html(response.dislikes)
                        //console.log(response)
                        $(".fa-thumbs-o-up")[0].style.color = "green"
                        $(".fa-thumbs-o-down")[0].style.color = ""

                    }
                });
            })

            $(".fa-thumbs-o-down").on('click',function(){
                id = $(".page-header-heading")[0].attributes.value.value
                url = "/dj/reaction/"+id+"/"+0;
                console.log(url);
                jQuery.ajax({
                    url: url,
                    type: 'get',
                    success: function (response) {
                        $("#like").html(response.likes)
                        $("#dislike").html(response.dislikes)
                        //console.log(response)
                        // Perform operation on the return value
                        $(".fa-thumbs-o-down")[0].style.color = "red"
                        $(".fa-thumbs-o-up")[0].style.color = ""

                    }
                });
            })

            $(".checkbox1").change(function() {
                if(this.checked)
                    $('.join').prop('disabled', false);
                else
                    $('.join').prop('disabled', true);
            });

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

        </script>

        <!-- <script src="/js/wavesurfer.js"></script> -->
        <!-- <script src="/js/wave-play-list.js"></script> -->
        <script type="text/javascript">

            function secondsToTime2(secs)
            {
                secs = Math.round(secs);
                var hours = Math.floor(secs / (60 * 60));

                var divisor_for_minutes = secs % (60 * 60);
                var minutes = Math.floor(divisor_for_minutes / 60);
                if(minutes < 10){
                    minutes = '0'+minutes;
                }

                var divisor_for_seconds = divisor_for_minutes % 60;
                var seconds = Math.ceil(divisor_for_seconds);
                if(seconds < 10){
                    seconds = '0'+seconds;
                }

                var obj = {
                    "h": hours,
                    "m": minutes,
                    "s": seconds
                };
                return obj;
            }

                var listWave1 = WaveSurfer.create({
                        container: document.querySelector('#audioWave'),
                        waveColor: 'grey',
                        progressColor: '#5bf0f0',
                        barHeight: 0.3,
                        responsive: true,
                        // backend: 'MediaElement',
                        mediaType:'audio',
                        // normalize: true,
                        barWidth: 2
                    });
                    listWave1.load('/audio/{{$musicCampaignAudio->audio}}');

                    function togglePlaying1(){

                        var bottomPause = $(document).find('#bottom_bar #audioControl1');
                        if(bottomPause.hasClass('fa-pause')){
                            bottomPause.closest('span').trigger('click');
                        }

                        $(document).find('.playPauseToggleHandle.single').toggleClass('fa-play fa-pause');
                        listWave1.playPause();
                    }

                    listWave1.on('finish', function() {
                        // setCurrentSong((currentTrack + 1) % links.length);
                        $(document).find('.playPauseToggleHandle.single').removeClass('fa-spinner fa-spin fa-play fa-pause').addClass('fa-play');
                    });

                    listWave1.on('audioprocess', function() {
                        if(listWave1.isPlaying()) {
                            var totalTime = listWave1.getDuration(),
                                currentTime = listWave1.getCurrentTime(),
                                remainingTime = totalTime - currentTime;
                            var time = secondsToTime2(remainingTime.toFixed(1));
                            $(document).find('.changeCurrentTime1').html(time.m+':'+time.s);
                            // $(document).find('.playPauseToggleHandle').removeClass('fa-spinner fa-spin fa-play').addClass('fa-play');
                        }
                    });

                    listWave1.on('ready', function() {
                        var totalTime = listWave1.getDuration(),
                            currentTime = listWave1.getCurrentTime(),
                            remainingTime = totalTime - currentTime;
                        var time = secondsToTime2(remainingTime.toFixed(1));
                        $(document).find('.changeCurrentTime1').html(time.m+':'+time.s);
                        $(document).find('.playPauseToggleHandle.single').removeClass('fa-spinner fa-spin fa-play fa-pause').addClass('fa-play');
                    });

        </script>

        <!-- <script type="text/javascript">
            $("iframe").width(350);
            $("iframe").height(200);
        </script> -->
        <script src="/js/campaign/graph.js"></script>
    @endsection
    @section('custom_js')
        
    @endsection

    </div>  
</main>
