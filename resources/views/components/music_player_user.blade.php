<link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet" />

<nav id="bottom_bar" class="navbar fixed-bottom d-flex align-items-center row" style="background-color:black; height:120px;">

    <!-- <button id="audioControl1" onclick="togglePlaying()">Play</button> -->
    <div id="first" class="col-md-4 col-8" style="position: relative;">
        <canvas id="progress1" width="1500" height="5" style="position: absolute;"></canvas>

        <audio id="audio1" ontimeupdate="updateBar()" src="/musicfile/Kalimba.mp3">
        </audio>
        <img id="image_player" class="ml-2" src="/images/profile-picture.jpg" width="50" height="50" alt="">
        <i class="fas fa-step-backward mx-3" style="color: white;"></i>
        <span onclick="togglePlaying()">
            <i id="audioControl1" action="play" class="fas fa-play" style="top: 14px;left: -139px;"></i>
        </span>

        <i class="fas fa-step-forward ml-3" style="color: white;"></i>
        <span class="ml-3" style="color: white;" id="current-time">4:30</span>
    </div>

    <div class="text-wrap col-md-3 col-3" style="margin-left:-100px; color:white">
        <span id="song_name_player" style="font-weight: bold;">{{$musicCampaignAudio->song_title}}</span> <br>
        <span id="artist_name_player" class="text-muted">{{$musicCampaignAudio->artist_name}}</span><br>
    </div>
    <div class="col-md-2 col-6" id="waveform1" style="width: 300px;margin-bottom: -70;margin-top: -50px; margin-left:-100px">
    </div>
    <i class="material-icons" style="color: white;">
        playlist_add
    </i>
    <div class="col-md-2 d-flex align-items-center">
        <a id="mute" class="btn" style="color: white;" onclick="mute()"><i id="icon" class="fas fa-volume-up" onclick="change('icon')" style="color: rgb(132, 255, 255);"></i></a>
        <input id="vol-control" type="range" min="0" max="100" step="1" class="slider" oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>
    </div>

</nav>
<!-- <link rel="stylesheet" href="/css/volume_slide.css"> -->
<script src="https://unpkg.com/wavesurfer.js"></script>
<script src="/js/wavesurfer.js"></script>
<script src="/js/music_bar.js"></script>
<script>
    var audio = document.getElementById("audio1").value;

    var wavesurfer = WaveSurfer.create({
        container: document.querySelector('#waveform1'),
        waveColor: 'grey',
        progressColor: 'grey',
        barHeight: 0.3,
        responsive: true,
    });
    wavesurfer.load('/musicfile/Kalimba.mp3');

    window.SetVolume = function(val) {
        var player = document.getElementById('audio1');
        player.volume = val / 100;
    }

    function mute() {
        var audio = document.getElementById('audio1');
        audio.muted = !audio.muted;
        return false;
    }

    function change(icon) {
        if (document.getElementById('icon').className == "fas fa-volume-up") {
            document.getElementById('icon').className = "fas fa-volume-mute";
        } else if (document.getElementById('icon').className = "fas fa-volume-mute") {
            document.getElementById('icon').className = "fas fa-volume-up";
        }
    }
</script>