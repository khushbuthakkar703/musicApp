@extends('layouts.djmanager')
@section('content')
<title>SpinStatz | Dashboard</title>
<div class="container-fluid">
    <div class="row">
        <ul class="nav navbar-nav navbar-left pagination">
            <li class="btn type-filter">
                <a class="btn btn-default" href="/djmanager/campaigns">Name</a></li>
            <li class="btn type-filter"><a class="btn btn-default" href="/dj/dashboard/rate">Spin Rate</a></li>
            <li class="btn type-filter">
                <select class="btn btn-default genre">
                    <option value="" disabled selected>Select Genre</option>
                    @foreach($genres as $genre)
                        <option href="/dj/dashboard/genres/{{$genre->music_type}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </li>
            <li class="btn type-filter"><a class="btn btn-default" href="/dj/dashboard/likes">likes</a></li>
        </ul>
    </div>
    <style>
    .type-filter {
        padding-right: 0px;
        padding-left: 0px;
    }
</style>
<div>

    @if (count($campaigns) > 0)
    <section class="campaigns" id="camp">
        @include('DjManager.lay')
    </section>
    @endif
</div>
</div>
<script type="text/javascript">
    document.getElementsByClassName("campaigns")[0].classList.add('active');
</script>

@include('CommonComponents.adPopUp')

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/jquery.ellipsis.min.js"></script>

<script type="text/javascript">

    function play(a)
    {
     var audio=null;
     audio = $(a).find('audio')[0];

     var toggle_class=$(a).attr('class');
     $(a).toggleClass("fa-pause");
     if(toggle_class=="fa fa-play music-btn")
     {
      // audio.pause();
      audio.play();
  }
  else
  {

      audio.pause();
      audio.currentTime = 0;
  }
}
$(function () {
    $('.genre').on('change', function () {

        $('.type-filter a').each(function () {
            $(this).removeClass("active")
        });

        $('.genre').addClass("active");
        var url = $(this).find(":selected").attr('href');
        getCampaigns(url);
        console.log(url)
            //getCampaigns(url);

        })

    $('body').on('click', '.type-filter a', function (e) {
        e.preventDefault();
        $('.genre').removeClass("active");

        $('.type-filter a').each(function () {
            $(this).removeClass("active")
        });

        $(this).addClass("active");
        var url = $(this).attr('href');
        getCampaigns(url);

    });

    $('body').on('click', '.pagination a', function (e) {
        e.preventDefault();
            //$('.pagination a').css('color', '#dfecf6');
            //$('.campaigns').innerHtml('<img style="position: relative; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            var url = $(this).attr('href');
            getCampaigns(url);
            //window.history.pushState("", "", url);
        });

    function getCampaigns(url) {
        console.log(url)
        $.ajax({
            url: url
        }).done(function (data) {
            $('#camp').html(data);
        }).fail(function () {
            alert('Campaigns could not be loaded.');
        });
    }
});

    /**
     * User balance every 30 sec update
     */
     function userBalance() {
        url = "/dj/user/balance";
        jQuery.ajax({
            url: url,
            type: 'get',
            success: function (response) {
                // Perform operation on the return value
                if (response && response.points_earned) {
                    $("#dj-earn-balance").text(response.points_earned);
                }
            }
        });
    }

    jQuery(document).ready(function () {
        setInterval(userBalance, 30000);
    });


    function reaction(id, reaction){
        url = "/dj/reaction/"+id+"/"+reaction;
        console.log(url);
        jQuery.ajax({
            url: url,
            type: 'get',
            success: function (response) {
                // Perform operation on the return value

            }
        });
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<style type="text/css">
.music-btn
{
    position: absolute;
    color: #fff;
    left: 32px;
    top: 21px;
    font-size: 3em !important;
}
</style>
