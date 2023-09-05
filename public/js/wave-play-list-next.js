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