@extends('layouts.campaignapp')
@section('content')
<title>SpinStatz | Spin Videos</title>
<div class="container-fluid">
	<div class="row">
		@foreach($spins as $spin)
			<div class="col-md-6 col-lg-4">
            <div class="widget widget-default widget-fluctuation">
                <header class="widget-header"><a href="" style="overflow:hidden;">{{$spin->dj()->dj()->first()->dj_name}}</a>
                    <span class="pull-right">Coliation: {{$spin->manager()->manager()->first()->company_name}}</span>
                </header>
                <div class="widget-body">
                    <!-- <iframe width="300" height="160" src="{{$spin->videoUrl}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                     <video width="300" height="160" controls>
                         <source src="{{$spin->videoUrl}}" type="video/ogv" />
                         <source src="{{$spin->videoUrl}}" type="video/mp4" />
                         <source src="{{$spin->videoUrl}}" type="video/webm" />
                        Your browser does not support the video tag.
                        </video> 
                </div>
                <header class="widget-header">
                    <span class="widget-statistic-description">Recorded Time: {{date("M/d/Y  h:i a", substr($spin->timestamp, 0, 10))}}</span>
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
@endsection 