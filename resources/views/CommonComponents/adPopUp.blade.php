@if(isset($getAds) && $getAds !=null && !isset($_COOKIE['disableAdPopUp']))

    <style>
        #closeBtnAds {
            position: absolute;
            top: -15px;
            right: 0;
            font-size: 31px;
            color: #ff0000;
        }
        #addShowPopup
        {
            background: #000000ad;
            margin-top:100px
        }
    </style>
    <div class="modal fade" tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false" id="addShowPopup">
        <div class="modal-dialog" role="addShowPopup">
            <div class="modal-content text-center">

                @if(isset($getAds->image) && $getAds->image != null)
                    <img src="{{'/'.$getAds->image}}" class="img-responsive" style="width: 100%">
                @elseif(isset($getAds->video_url) && $getAds->video_url != null)

                    @php
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $getAds->video_url, $match);
                    @endphp
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$match[1]}}"
                            frameborder="0" id="vidio_src" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                @endif
                <a href="javascript:void(0);" id="closeBtnAds"><span
                            aria-hidden="true">&times;</span></a>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#addShowPopup').modal('show');

            $('#closeBtnAds').click(function () {
                var url = "/advertisement/closeAds";
                $.get(url, function (data) {
                    $('#addShowPopup').modal('hide');
                });
            });

            $(document).on('click','#closeBtnAds',function() {
                $('#addShowPopup').modal('hide');
                $('#vidio_src').removeAttr("src");
            });

        });
    </script>

@endif