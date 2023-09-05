
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
</style>
<div class="container custom_lay_blade">
    @php
        $songCounter = 0;
    @endphp
    @foreach($campaigns as $campaign)


        <div id="opac" class="row list-wave-play-items d-flex border-bottom border-secondary pt-4"  data-song-index="{{$songCounter}}"  data-title="{{$campaign->song_title}}" data-img="/{{$campaign->artwork}}" data-artist="{{$campaign->artist_name}}" data-href="{{asset('audio/'.$campaign->audio)}}">
            <!-- /audio/1521755341K.O%20MCcoy%20-%20Somewhere%20Out%20There.mp3 /audio/{{ $campaign->audio }} -->
            <div class="col-9 col-md-3 mb-4 pl-3 sm-mb-5">

                <input type="hidden" id="audio" value="{{ $campaign->audio }}">
                <div class="d-flex">
                <span onclick="togglePlaying()">
                    <div class="divbutton" >
                        <img action="play" class="songImage" src="/{{$campaign->artwork}}" alt="{{$campaign->song_title}}" width="60" height="60">
                        <img class="image_hover list-wave-play-items" src="/img/play-hover.png"  data-song-index="{{$songCounter}}"  data-title="{{$campaign->song_title}}" data-img="/{{$campaign->artwork}}" data-artist="{{$campaign->artist_name}}" data-href="{{asset('audio/'.$campaign->audio)}}" style="display: none; color:white" ></img>
                    </div>
                </span>
                    <div class="ml-2 ml-15">
                        <span id="song_name">{{$campaign->song_title}}</span> <br>
                        <span id="artist_name" class="text-muted">{{$campaign->artist_name}}</span> <br>
                        <p class="mt-3" style="font-weight:lighter; color:rgb(132, 255, 255); font-size:larger;">{{$campaign->spin_rate > 0 ? 1 : 0}} $/Spin</p>
                    <!-- <p class=" mt-3" style="font-weight: bold; font-size:larger">${{$campaign->spin_rate/2}}/Spin</p> -->
                    </div>
                </div>
            </div>
             <div class="col-1 col-sm-1">
                @include('components.playlist_button')
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
		  <div class="col-3 col-md-2 ml-0 pl-0 spech_meange sm-ml-5">
               
                <div class="download-remaining"><span style="text-align: center">
            <a class="view-song-details" href="#">3 Days to play song 2 times</a></span></div>
            </div>
				<div class="col-3 col-md-2 ml-0 pl-0 spech_meange sm-ml-5">
				<a style="color: rgb(132, 255, 255); border: 1px solid;" href="/dj/campaign/{{$campaign->campaign_id}}" class="btn mt-4 float-right add_funds_btn" role="button">DETAILS</a>
					<a style="color: rgb(132, 255, 255); border: 1px solid;" href="#" class="btn mt-4 float-right add_funds_btn" role="button">DOWNLOAD</a>
					
				</div>
        </div>
        @php
            $songCounter++;
        @endphp
    @endforeach
</div>
<div class="pull-right">
				
					<a style="color: rgb(132, 255, 255); border: 1px solid;" href="#" class="btn mt-4 float-right add_funds_btn" role="button">DOWNLOAD ALL</a>
					
				</div><BR>
<div class="row pagination-lg dashboard-pagination ml-5" style="margin-bottom: 70px;">
    {{ $campaigns->links() }}
</div>

<!-- <script src="/js/music_bar.js"></script> -->
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.0.52/wavesurfer.min.js"></script> -->
<!-- <script src="https://unpkg.com/wavesurfer.js"></script> -->

<script>
    myCanvases = $(".wavbar")
    myBarcharts = []
    for(var i=0; i< myCanvases.length; i++) {
        this_canvas = myCanvases[i]
        wav_data = this_canvas.attributes["wav_data"].value.split(",")
        console.log(wav_data)

        
            myBarcharts[i]  = new Barchart(
                {
                    canvas: this_canvas,
                    padding: 1,
                    data: wav_data,
                    colors: ["white"]
                }
            )

            
            myBarcharts[i].draw()
        // });
    }
</script>


<style type="text/css">
    .divbutton{    position: relative;}
    .divbutton:hover .image_hover {position: absolute; left: 0px; top: 0px;  width: 100%; background-color: #fff3; display: inline-block !important; cursor: pointer;}
</style>

@include('components.music_player')
