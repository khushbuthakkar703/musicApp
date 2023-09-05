@extends('layouts.djmanager')
@section('content')
    <title>SpinStatz | {{$musicCampaign->campaign_name}}</title>
    <!-- <header class="page-header"> -->
        <div class="container-fluid align-middle">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-4 p-2" style="margin-top: 20px; margin-bottom: 15px">
                    <h2 class="page-header-heading text-justify" value="{{$musicCampaignAudio->id}}">
                        <span class="typcn typcn-home page-header-heading-icon">
                        </span>
                            {{$musicCampaignAudio->song_title}}
                    </h2>
                </div>
                <div class="col-xs-12 col-sm-8 col-lg-5 align-middle" style="margin-top: 15px; margin-bottom: 20px">
                    <audio controls preload="metadata" controlsList="nodownload">
                        <source src="/audio/{{$musicCampaignAudio->audio}}" type="audio/mpeg">
                    </audio>
                    &nbsp&nbsp
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-3" style="margin-top: 20px; margin-bottom: 15px">
                    <h2>
                        <i class="fa fa-thumbs-o-up" aria-hidden="true" data-toggle="tooltip" >
                            
                        </i>
                        <span id="like">{{$musicCampaign->likes}}</span>&nbsp&nbsp
                        <i class="fa fa-thumbs-o-down" aria-hidden="true" data-toggle="tooltip"></i>
                        <span id="dislike">{{$musicCampaign->dislikes}}</span>
                    </h2>
                </div>  
            </div>
        </div>
    <!-- </header> -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget widget-default widget-fluctuation">
                    <header class="widget-header">
                        TOTAL SPINS
                    </header>
                    <div class="widget-statistic-body">
                        <span class="widget-statistic-value"
                              style="font-size: 48px"> &nbsp;{{$musicCampaign->total_spin}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="widget widget-statistic widget-primary">
                    <header class="widget-statistic-header">Remaining Spin</header>
                    <div class="widget-statistic-body">
                        <span class="widget-statistic-value">
                            <!-- <span class="fa fa-usd"></span> -->
                            @if($musicCampaign->spin_rate !=0)
                                {{floor($musicCampaign->campaign_balance/$musicCampaign->spin_rate)}}
                             @endif   
                            </span>
                        <span class="widget-statistic-icon fa fa-credit-card-alt"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="widget widget-statistic widget-purple">
                    <header class="widget-statistic-header">Spin Rate</header>
                    <div class="widget-statistic-body">
                        <span class="widget-statistic-value">
                            <span class="fa fa-usd"></span>
                            {{$musicCampaign->spin_rate/2}}/<span
                                    style="font-size: 24px">Spin</span></span>
                        <span class="widget-statistic-description">Points DJs will receive for each succussfully reported spin.</span>
                        <span class="widget-statistic-icon fa fa-support"></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="widget widget-default">
                    <input type="hidden" id="campaign_id" value="{{$musicCampaign->id}}">
                    <header class="widget-header">
                        Spin Graph
                    </header>
                    <div class="widget-body">
                        <canvas id="graphmonthlyspin" height="75px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget widget-default">
                    <header class="widget-header">Campaign Details
                        <div class="widget-header-actions">
                    </header>
                    <div class="widget-body widget-body-md">
                        <div>
                            <em>"{{$musicCampaignAudio->song_title}}"
                            </em> / {{$musicCampaignAudio->artist_name}}
                        </div>
                        <div>
                            <b>BPM</b>
                        </div>
                        <div style="font-size: 16px">{{$musicCampaign->bpm}} </div>
                        <div><b>Genre</b></div>
                        <div style="font-size: 16px">{{App\MusicType::find(json_decode($musicCampaignAudio->genre)[0])->name}}</div>
                        <div><b>Label</b></div>
                        <div style="font-size: 16px">{{$musicCampaignAudio->company_name}}</div>
                        <div>
                            <div>
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 
                                {{$musicCampaign->likes}}
                            </div>
                            <div class="float-right"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> {{$musicCampaign->dislikes}}
                            </div>
                        </div>
                        <div class="row margin-top-15"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="widget widget-primary widget-achievement">
                    <div><img src="/{{$musicCampaignAudio->artwork}}" alt="{{$musicCampaign->campaign_name}}"
                              class="achievement-image">
                        <p class="achievement-description">Start date<strong> {{$musicCampaign->created_at->todatestring()}}</strong> Campaign active
                            <!-- <strong>21 DAYS</strong> --></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                
                
                    <li class="profile-resource-list-item">
                        <i class="fa fa-music" aria-hidden="true"></i>&nbsp{{$musicCampaignAudio->song_title}}
                        <a href="/music/download/{{$musicCampaignAudio->id}}">
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                    class="fa fa-download"> </span>
                                Download
                            </button>
                        </a>
                    </li>
                    @if($instrumental!=null)
                        <li class="profile-resource-list-item">
                            <i class="fa fa-music" aria-hidden="true"></i>&nbsp Instrumental
                            <a href="/{{$instrumental->song_path}}" download="{{$musicCampaignAudio->song_title}}_instrumental">
                                <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                        class="fa fa-download"> </span>
                                    Download
                                </button>
                            </a>
                        </li>
                    @endif
                    @if($radio!=null)
                        <li class="profile-resource-list-item">
                            <i class="fa fa-music" aria-hidden="true"></i>&nbsp Radio
                            <a href="/{{$radio->song_path}}" download ="{{$musicCampaignAudio->song_title}}_radio">
                                <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                        class="fa fa-download"> </span>
                                    Download
                                </button>
                            </a>
                        </li>
                    @endif
                    @if($acappella!=null)
                        <li class="profile-resource-list-item">
                            <i class="fa fa-music" aria-hidden="true"></i>&nbsp Acappella
                            <a href="/{{$acappella->song_path}}_acappela">
                                <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right download"><span
                                        class="fa fa-download" download ="{{$musicCampaignAudio->song_title}}"> </span>
                                    Download
                                </button>
                            </a>
                        </li>
                    @endif
                
                
            </div>
</div>
@if($musicCampaignAudio->youtube_feature != null)
            @php
               $url = $musicCampaignAudio->youtube_feature;
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                $youtubeId = $match[1];
            @endphp
            <iframe width="350" height="200" src="https://www.youtube.com/embed/{{$youtubeId}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                
            </iframe>
            @endif

            
                
                
                
                    
            </div>

            
<script type="text/javascript">
    $("iframe").width(350);
    $("iframe").height(200);
</script>
<script src="/js/campaign/graph.js"></script>
@endsection
@section('custom_js')
<script type="text/javascript">
    $(".fa-thumbs-o-up").on('click',function(){
        id = $(".page-header-heading")[0].attributes.value.value
        url = "/dj/reaction/"+id+"/"+1;
        console.log(url);
        jQuery.ajax({
            url: url,
            type: 'get',
            success: function (response) {
                // Perform operation on the return value
                $("#like").html(response.likes)
                $("#dislike").html(response.dislikes)
                //console.log(response)
                $(".fa-thumbs-o-up")[0].style.color = "green"
                $(".fa-thumbs-o-down")[0].style.color = ""
                
            }
        });
    })

    $(".fa-thumbs-o-down").on('click',function(){
        id = $(".page-header-heading")[0].attributes.value.value
        url = "/dj/reaction/"+id+"/"+0;
        console.log(url);
        jQuery.ajax({
            url: url,
            type: 'get',
            success: function (response) {
                $("#like").html(response.likes)
                $("#dislike").html(response.dislikes)
                //console.log(response)
                // Perform operation on the return value
                $(".fa-thumbs-o-down")[0].style.color = "red"
                $(".fa-thumbs-o-up")[0].style.color = ""
                
            }
        });
    })

    $(".checkbox1").change(function() {
        if(this.checked)
            $('.join').prop('disabled', false);
        else
          $('.join').prop('disabled', true);
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
@endsection
