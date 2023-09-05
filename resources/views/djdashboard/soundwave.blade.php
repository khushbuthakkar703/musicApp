<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.0.52/wavesurfer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>



<script>
    $(document).ready(function () {
        $('.js-wave').each(function (i, el) {
            var wavesurfer = Object.create(WaveSurfer);

            wavesurfer.init({
                container: el,
                waveColor: 'violet',
                progressColor: 'purple'
            });

            wavesurfer.load($(el).data('path'));

            wavesurfer.on('ready', function () {
                // this.play();
            }.bind(wavesurfer));
        });
    });
</script>
