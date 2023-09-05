@php
$songCounter = 0;
@endphp
@foreach($campaigns as $campaign)


<div id="opac" class="row list-wave-play-items d-flex border-bottom border-secondary pt-4 opac-music-list"
    data-song-index="{{$songCounter}}" data-title="{{$campaign->song_title}}" data-img="/{{$campaign->artwork}}"
    data-artist="{{$campaign->artist_name}}" data-href="{{asset('audio/'.$campaign->audio)}}">
    <!-- /audio/1521755341K.O%20MCcoy%20-%20Somewhere%20Out%20There.mp3 /audio/{{ $campaign->audio }} -->
    <div class="col-9 col-md-3 mb-4 sm-mb-5">

        <input type="hidden" id="audio" value="{{ $campaign->audio }}">
        <div class="d-flex">
            <span onclick="togglePlaying()">
                <div class="divbutton">
                    <img action="play" class="songImage" src="/100x100/{{$campaign->audio_id}}.png"
                        alt="{{$campaign->song_title}}" width="60" height="60">
                    <img class="image_hover list-wave-play-items" src="/img/play-hover.png"
                        data-song-index="{{$songCounter}}" data-title="{{$campaign->song_title}}"
                        data-img="/{{$campaign->artwork}}" data-artist="{{$campaign->artist_name}}"
                        data-href="{{asset('audio/'.$campaign->audio)}}" style="display: none; color:white"></img>
                </div>
            </span>
            <div class="ml-2">
                <span id="song_name">{{$campaign->song_title}}</span> <br>
                <span id="artist_name" class="text-muted">{{$campaign->artist_name}}</span> <br>
                <p class="mt-3" style="font-weight:lighter; color:rgb(132, 255, 255); font-size:larger;">
                    ${{App\Helpers\Settings::get_dj_spin_rate($dj->star,$campaign->spin_rate)}}/Spin</p>
                <!-- <p class=" mt-3" style="font-weight: bold; font-size:larger">${{$campaign->spin_rate/2}}/Spin</p> -->
            </div>
        </div>
    </div>
    <div class="col-3 col-md-2 ml-0 pl-0 spech_meange sm-ml-5">
        @include('components.like_playlist_button')
        <div class="show-more-button">
            <a class="view-song-details" href="/dj/campaign/{{$campaign->campaign_id}}">View Song</a></div>
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
        <canvas class="wavbar" audio_id="{{$campaign->audio_id}}"
            style="height: 100px; width: 465px;margin-bottom: -20px;margin-top: -30px;margin-left: 19px;"
            wav_data="{{$campaign->wav_data}}">

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
<script src="/js/wavesurfer.js"></script>
<script src="/js/wave-play-list-next.js"></script>
<script>
    myCanvases = $(".wavbar")
    myBarcharts = [];
    for(var i=0; i< myCanvases.length; i++) {
        this_canvas = myCanvases[i]
        wav_data = this_canvas.attributes["wav_data"].value.split(",")
        myBarcharts[i]  = new Barchart(
            {
                canvas: this_canvas,
                padding: 0,
                data: wav_data,
                colors: ["white"]
            }
        )
        myBarcharts[i].draw()        
    }
</script>
