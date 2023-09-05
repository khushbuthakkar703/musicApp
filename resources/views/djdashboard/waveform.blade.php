{{--<div id="waveform" style="width: 300px;"></div>--}}

<script src="https://unpkg.com/wavesurfer.js"></script>

<script>
    var wavesurfer = WaveSurfer.create({
        container: document.querySelector('#waveform'),
        waveColor: 'grey',
        barHeight: 0.5,
        responsive: true,
        cursorHeight: 0,
    });

    wavesurfer.load('/musicfile/Kalimba.mp3');
</script>
