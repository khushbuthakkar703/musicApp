function secondsToTime(secs)
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



// Create a WaveSurfer instance
var wavesurfer;

var wavesurfer = WaveSurfer.create({
    container: document.querySelector('#waveform1'),
    waveColor: 'grey',
    progressColor: '#5bf0f0',
    barHeight: 0.25,
    responsive: true,
    backend: 'MediaElement',
    mediaType:'audio',
    // normalize: true,
    barWidth: 2
});

wavesurfer.on('click', function() {
    wavesurfer.play();
});


// The playlist links
var links = document.querySelectorAll('img.list-wave-play-items');
var currentTrack = 0;

// Load a track by index and highlight the corresponding link
var setCurrentSong = function(index) {
    wavesurfer.stop();
    $(document).find('.enableDisablePlayer').removeClass('display-none');

    if(index==0){
        $(document).find('.prev-song').addClass('dissableClick');
    }else{
        $(document).find('.prev-song').removeClass('dissableClick');
    }

    if(($(document).find('img.list-wave-play-items').length - 1) == index){
        $(document).find('.next-song').addClass('dissableClick');
    }else{
        $(document).find('.next-song').removeClass('dissableClick');
    }

    links[currentTrack].classList.remove('active');
    currentTrack = index;
    console.log('current img',links[currentTrack]);
    links[currentTrack].classList.add('active');
    console.log('href',links[currentTrack].getAttribute('data-href'));
    wavesurfer.load(links[currentTrack].getAttribute('data-href'));
    wavesurfer.play();

    /* Play Pause Button */
    
    $(document).find('.playPauseToggleHandle.list').addClass('fa-pause fa-play').addClass('fa-spinner fa-spin');

    var currentRow = $(document).find('div.list-wave-play-items:nth-child('+(currentTrack + 1)+')')
    var songName = currentRow.find('#song_name').html();
    var artisName = currentRow.find('#artist_name').html();
    var imageUrl = currentRow.find('.songImage').attr('src');

    $(document).find('.footer_player').find('#song_name_player').html(songName);
    $(document).find('.footer_player').find('#artist_name_player').html(artisName);
    $(document).find('.footer_player').find('#image_player').attr('src',imageUrl);
};

// Load the first track
// setCurrentSong(currentTrack);

var isInit=true;

wavesurfer.on('audioprocess', function() {
    if(wavesurfer.isPlaying()) {
        var totalTime = wavesurfer.getDuration(),
            currentTime = wavesurfer.getCurrentTime(),
            remainingTime = totalTime - currentTime;
        var time = secondsToTime(remainingTime.toFixed(1));
        $(document).find('.changeCurrentTime').html(time.m+':'+time.s);
        if(isInit==true){
            $(document).find('.playPauseToggleHandle.list').removeClass('fa-spinner fa-spin fa-play').addClass('fa-play');
        }else{
            $(document).find('.playPauseToggleHandle.list').removeClass('fa-spinner fa-spin fa-play').addClass('fa-pause');
        }
        isInit = false;
    }
});

// wavesurfer.load('/musicfile/Kalimba.mp3');

// Load the track on click
Array.prototype.forEach.call(links, function(link, index) {
    link.addEventListener('click', function(e) {
        // e.preventDefault();
        setCurrentSong(index);
    });
});

// Play on audio load
wavesurfer.on('ready', function() {
    var totalTime = wavesurfer.getDuration(),
        currentTime = wavesurfer.getCurrentTime(),
        remainingTime = totalTime - currentTime;
    var time = secondsToTime(remainingTime.toFixed(1));
    $(document).find('.changeCurrentTime').html(time.m+':'+time.s);
    $(document).find('.playPauseToggleHandle.list').removeClass('fa-spinner fa-spin fa-play').addClass('fa-pause');
    wavesurfer.play();
});

wavesurfer.on('error', function(e) {
    wavesurfer.stop()
    console.warn(e);
});

// Go to the next track on finish
wavesurfer.on('finish', function() {
    // setCurrentSong((currentTrack + 1) % links.length);
    $(document).find('.playPauseToggleHandle.list').removeClass('fa-spinner fa-spin fa-play fa-pause').addClass('fa-play');
});


function togglePlaying(){
    var bottomPause = $(document).find('#bottom_bar #audioControl1');
    if(bottomPause.hasClass('fa-spin')){
        $(".list-wave-play-items.active").attr("src","/img/pause-hover.png");
    }
    else if(bottomPause.hasClass('fa-play')) {
        $(".list-wave-play-items.active").attr("src","/img/pause-hover.png");
    }
    else {
        $(".list-wave-play-items.active").attr("src","/img/play-hover.png");
    }

	$(document).find('.playPauseToggleHandle.list').toggleClass('fa-play fa-pause');
	wavesurfer.playPause();
    console.log(wavesurfer.playPause());
}

function SetVolume(value){
	value = value/100;
	wavesurfer.setVolume(value);
}

function toggleMute(){
	$(document).find('.toggleMuteDesign').toggleClass('fa-volume-up fa-volume-down');
	wavesurfer.toggleMute();
}

function prevSong(){
    $(document).find('div.list-wave-play-items.active').removeClass('active');
    currentTrack = currentTrack - 1;
    setCurrentSong(currentTrack);
}

function nextSong(){
    $(document).find('div.list-wave-play-items.active').removeClass('active');
    currentTrack = currentTrack + 1;
    setCurrentSong(currentTrack);
}


// jQuery(function($){
//     $(document).ready(function(){
//         setTimeout(function(){
//             var waveArray = [];
//             $(document).find('div.list-wave-play-items').each(function(index){
//                 var parentDiv = $(this);
//                 var idName = parentDiv.find('.waveform-item').attr('id');
//                 var listWave = WaveSurfer.create({
//                     container: document.querySelector('#'+idName),
//                     waveColor: 'grey',
//                     progressColor: 'grey',
//                     barHeight: 0.25,
//                     responsive: true,
//                     // backend: 'MediaElement',
//                     mediaType:'audio',
//                     // normalize: true,
//                     barWidth: 2
//                 });
//                 listWave.load(parentDiv.attr('data-href'));
//                 waveArray.push({
//                     listWave:listWave,
//                     element:index
//                 });
//             });
//             console.log(waveArray);
//             $.each(waveArray,function(index,item){
//                 item.listWave.on('ready', function() {
//                     console.log(item.listWave.getDuration());
//                     var time = secondsToTime(item.listWave.getDuration());
//                     $(document).find('div.list-wave-play-items:nth-child('+(index+1)+') #time-remaining').html(time.m+':'+time.s);
//                 });
//             });
//         },3000);
//     });
// });