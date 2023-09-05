
@php
    $currentUser = auth()->user();
    $djdata = App\Dj::where('user_id',$currentUser->id)->first();
    if($djdata != null && $djdata->type == "online"){
    $isOnlineDj = true;
    }else{
    $isOnlineDj = false;
    }
@endphp
<link rel="stylesheet" type="text/css" href="/css/custom.css" />
<style type="text/css">
  input#vol-control {    height: 1px; }
  input#vol-control::-webkit-slider-thumb { width:3px; }
  input#vol-control::-moz-range-thumb { width:3px; }
  .custom-lay { width: 100% !important; max-width: 100% !important; }
</style>
<div id="musicList" class="container custom-lay">
    @php
        $songCounter = 0;
    @endphp
    @foreach($campaigns as $campaign)


        <div id="opac" class="row list-wave-play-items d-flex border-bottom border-secondary pt-4 opac-music-list"  data-song-index="{{$songCounter}}"  data-title="{{$campaign->song_title}}" data-img="/{{$campaign->artwork}}" data-artist="{{$campaign->artist_name}}" data-href="{{asset('audio/'.$campaign->audio)}}">
            <!-- /audio/1521755341K.O%20MCcoy%20-%20Somewhere%20Out%20There.mp3 /audio/{{ $campaign->audio }} -->
            <div class="col-9 col-md-3 mb-4 sm-mb-5">

                <input type="hidden" id="audio" value="{{ $campaign->audio }}">
                <div class="d-flex">
                <span onclick="togglePlaying()">
                    <div class="divbutton" >
                        <img action="play" class="songImage" src="/100x100/{{$campaign->audio_id}}.png" alt="{{$campaign->song_title}}" width="60" height="60">
                        <img class="image_hover list-wave-play-items" src="/img/play-hover.png"  data-song-index="{{$songCounter}}"  data-title="{{$campaign->song_title}}" data-img="/{{$campaign->artwork}}" data-artist="{{$campaign->artist_name}}" data-href="{{asset('audio/'.$campaign->audio)}}" style="display: none; color:white" ></img>
                    </div>
                </span>
                    <div class="ml-2">
                        <span id="song_name">{{$campaign->song_title}}</span> <br>
                        <span id="artist_name" class="text-muted">{{$campaign->artist_name}}</span> <br>
<!--                        <p class="mt-3" style="font-weight:lighter; color:rgb(132, 255, 255); font-size:larger;">{{$campaign->spin_rate > 0 ? 1 : 0}} $/Spin</p>-->
                        <p class=" mt-3" style="font-weight:lighter; color:rgb(132, 255, 255); font-size:larger;">
                            ${{App\Helpers\Settings::get_dj_spin_rate($djdata->star,$campaign->spin_rate)}}/Spin
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-3 col-md-2 ml-0 pl-0 spech_meange sm-ml-5">
                @include('components.like_playlist_button')
                <div class="show-more-button">
                  <a class="view-song-details" href="/dj/campaign/{{$campaign->campaign_id}}">Download</a></div>
            </div>

            <div class="col-4 col-md-2 ml-0 pl-0 font-change" style="font-size: small; color:grey;">
                @php
                    $genres = json_decode($campaign->genre)
                @endphp
                <?php
                $i = 0;
                ?>
                @foreach($genres as $genre)
                    <?php
                    if ($i <= 5) {
                    ?>
                    {{App\MusicType::find($genre)->name}},
                    <?php $i++;
                    }
                    ?>

                @endforeach

                <br>
                BPM: <span>{{$campaign->bpm}}</span> <br>
                Total Spins: <span>{{$campaign->total_spin}}</span>
            </div>
            <div class="col-12 col-md-4 ml-5 d-flex align-items-center ml-0">
              <canvas class="wavbar" audio_id="{{$campaign->audio_id}}" style="height: 100px; width: 465px;margin-bottom: -20px;margin-top: -30px;margin-left: 19px;"
              wav_data = "{{$campaign->wav_data}}"
              >

              </canvas>
<!--              <img src="/wavs/{{$campaign->audio_id}}.png" style="position: absolute">-->
<!--                <span class="mr-2" id="time-remaining">00:00</span>-->
<!--                <div id="listing-wave-{{$songCounter}}" class="waveform-item waveform_custom" style="  height: 100px; width: 400px;margin-bottom: -20px;margin-top: -30px;margin-left: 19px;"></div>-->
                <!-- <div class="js-wave" data-path="/musicfile/Kalimba.mp3"></div> -->
            </div>
        </div>
        @php
            $songCounter++;
        @endphp
    @endforeach
</div>
<div id="loadMusic" style="display: none;">
    <img src="{{ asset('loading.gif') }}" alt="Loading..." style="width: 200px; height: 175px; margin: 0% 550px;">
</div>
<input type="hidden" id="dj_page" value="1" />
<input type="hidden" id="dj_max_page" value="{{ @$maxPage }}" />
<input type="hidden" id="beamUp"/>
<!-- <script src="/js/music_bar.js"></script> -->
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.0.52/wavesurfer.min.js"></script> -->
<!-- <script src="https://unpkg.com/wavesurfer.js"></script> -->

<script>
    var didScroll = false;
    myCanvases = $(".wavbar")
    myBarcharts = []
    for(var i=0; i< myCanvases.length; i++) {
        this_canvas = myCanvases[i]
        wav_data = this_canvas.attributes["wav_data"].value.split(",")
        console.log(wav_data)


            myBarcharts[i]  = new Barchart(
                {
                    canvas: this_canvas,
                    padding: 0,
                    data: wav_data,
                    colors: ["white"]
                }
            )


            myBarcharts[i].draw()
        // });
    }
  function pageCountUpdate(){
    var page = parseInt($('#dj_page').val());
    var max_page = parseInt($('#dj_max_page').val());
    if(page < max_page){
        $('#dj_page').val(page+1);
        var nextPage = $('#dj_page').val();
        getMusics(nextPage);
    }
  }
  
  function getMusics(page){
      jQuery.ajax({
          type: "GET",
          url: "{{Request::url()}}?page="+ page,
          success: function(html) {
            $('#loadMusic').hide();
            $('#musicList .opac-music-list:last').after(html);
          }
      });
  }
  function scrollCall(){
    if(Math.ceil($('main.djdashboard-post').scrollTop() + $('main.djdashboard-post').innerHeight()) >= $('main.djdashboard-post')[0].scrollHeight){
        $('#loadMusic').show();
        setTimeout(function(){
            pageCountUpdate();
        },1500);
        didScroll = false;
    }
  }
    $(function(){
        $('main.djdashboard-post').scroll(function() {
            if(didScroll === false) didScroll = true;
            else scrollCall();
        });
    })
</script>


<style type="text/css">
    .divbutton{    position: relative;}
    .divbutton:hover .image_hover {position: absolute; left: 0px; top: 0px;  width: 100%; background-color: #fff3; display: inline-block !important; cursor: pointer;}
</style>

@include('components.music_player')
