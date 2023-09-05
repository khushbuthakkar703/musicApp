<link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet" />

<nav id="bottom_bar" class="navbar enableDisablePlayer fixed-bottom display-none d-flex align-items-center row footer_player" style="background-color:black;">

    <!-- <button id="audioControl1" onclick="togglePlaying()">Play</button> -->
    <div id="first" class="col-md-3 col-3 music_player_blade" style="position: relative;">
        <canvas id="progress1" width="1500" height="5" style="position: absolute;"></canvas>

<!--        <audio id="audio1" ontimeupdate="updateBar()" src="/musicfile/Kalimba.mp3">-->
<!--        </audio>-->
        <img id="image_player" style="margin-left: 0;" src="/images/profile-picture.jpg" width="50" height="50" alt="">
        <i class="fas fa-step-backward mx-5 prev-song" onclick="prevSong()" style="color: white;"></i>
        <span onclick="togglePlaying()">
            <i id="audioControl1" action="play" class="fas playPauseToggleHandle list fa-spinner fa-spin" style="top: 14px;left: -139px; font-size:large"></i>
        </span>

        <i class="fas fa-step-forward ml-20 next-song" onclick="nextSong()" style="color: white;"></i>
        <span class="ml-20 changeCurrentTime" style="color: white;" id="current-time">00:00</span>
    </div>

    <div class="text-wrap col-md-3 col-4" style="color:white">
        <span id="song_name_player">Somewhere Out There</span> <br>
        <span id="artist_name_player" class="text-muted">Ka McCay</span><br>
    </div>
    <div class="col-md-3 col-5" id="waveform1" style="width: 400px;margin-bottom:-60;margin-top: -50px; margin-left:-40px">
    </div>
    <i class="material-icons" style="color: white;">
        playlist_add
    </i>
    <div class="col-md-2 d-flex align-items-center music_player_sound" style="margin-right: -20px;">
        <a id="mute" class="btn" style="color: white;" onclick="toggleMute()"><i id="icon" class="fas toggleMuteDesign fa-volume-up" style="color: rgb(132, 255, 255);"></i></a>
        <input id="vol-control" type="range" min="0" max="100" step="1" class="slider" oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>
    </div>

</nav>
<style type="text/css">
    body .custom_lay_blade #opac.list-wave-play-items.active{ background-color: rgba(255, 255, 255, 0.1) !important; }
</style>
<script src="/js/wavesurfer.js"></script>
<script src="/js/wave-play-list.js"></script>
<style type="text/css">
    ::-moz-selection { background: #000; }
    ::selection { background: #000; }
    .dissableClick{ opacity: 0.5; pointer-events: none; }
    .display-none{ display: none !important; }
</style>
