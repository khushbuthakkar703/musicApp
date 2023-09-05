@extends('v3.layouts.app')
@section('content')
<title>SpinStatz | Spin Videos</title>
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content">
    <br><div class="container">
        <div class="row">
            @foreach($spins as $spin)
            <div class="col-md-4 campaign_song_box">
                <div class="bg_sngvi">
                    <div><a href="" style="overflow:hidden;">{{$spin->dj()->dj()->first()->dj_name}}</a>
                        <span class="pull-right">Coliation: {{$spin->manager()->manager()->first()->company_name}}</span>
                    </div>
                    <div class="videoproof">

                        <!-- <iframe  src="https://www.youtube.com/embed/8TUVfO3_Auw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>

                        </iframe> -->
                        <video class="responsive-iframe" controls>
                            <source src="http://spinstatz.org/records/{{$spin->videos}}" type="video/ogv" />
                            <source src="http://spinstatz.org/records/{{$spin->videos}}" type="video/mp4" />
                            <source src="http://spinstatz.org/records/{{$spin->videos}}" type="video/webm" />
                            Your browser does not support the video tag.
                        </video>

                    </div>
                    <header class="widget-header">
                        {{--                    <span class="widget-statistic-description">Recorded Time: {{$spin->created_at }}</span>--}}
                        <span class="widget-statistic-description">Played: {{date("M/d/Y h:i a", strtotime($spin->created_at)) }}</span>
                        <span class="label label-info pull-right"><a target="_blank" href="http://maps.google.com/?q={{$spin->latitude}},{{$spin->longitude}}">Location</a></span>
                    </header>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            {{ $spins->links() }}
        </div>
    </div>
</main>
@endsection
