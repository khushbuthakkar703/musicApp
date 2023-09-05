@extends('layouts.campaignapp')
@section('content')
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content spin_videov2">
	<br><br><div class="container">
		<div class="row">
			 <div class="col-md-12">
				 <div>
            <p style="font-size: 30px; color:#FFF">DAILY ACTIVITY</p>
          </div><br><br> 
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody>
				  <tr>
						<img src="/{{$campaign_audio->artwork}}" width="150" height="150" alt=""/>


						<div>
							<strong>Song Title:&nbsp;</strong>{{$campaign_audio->song_title}}
					    </div>
				  </tr>
					
				  <tr>
					    <div>
				<strong>Artist Name:&nbsp;</strong>{{$campaign_audio->artist_name}}
					    </div>
			      </tr>
					<tr>
					    <div>
				<strong>Label Name:&nbsp;</strong>{{$campaign_audio->company_name}}
					    </div>
			      </tr>
					<tr >
						<div><strong>Artist Website:&nbsp;</strong>
							<a href="#">{{$campaign_audio->artist_website}}</a>
						</div>
					</tr>
					<tr>
						<div><strong>Video Link:&nbsp;</strong>
						<a href="{{$campaign_audio->youtube_feature}}">Youtube</a>
						</div>
					</tr>
				</tbody>
			</table>
			<div class="col-12 mt-5 pl-15 table_layout">
				<table class="col-md-12 mt-4 mb-4" role="table">
					<tbody>
						<tr>
							<td colspan="2" align="center"> <ul class="pager">
								<li class="previous">
									<a href="/campaign/getspintable?week={{$weekCnt+1}}"><span aria-hidden="true">←</span> Older</a>{{Carbon\Carbon::parse($sunday)->format('M d')}} - {{Carbon\Carbon::parse($saturday)->format('M d')}}</li>

								<li class="next"><a href="/campaign/getspintable?week={{$weekCnt-1}}">Newer <span aria-hidden="true">→</span></a></li>

							</ul></td>
						</tr>
					</tbody>
				</table>
				<div>
                   
                          <table class="col-md-12" role="table">
                <thead role="rowgroup">
                	<div class="row">
                    	<tr role="row">
							<th></th>
							 <th role="columnheader" >DJ Name</th>
							 <th role="columnheader" >Country</th>
							 <th role="columnheader" >City</th> 
							 <th role="columnheader" >Sunday</th>
					 		 <th role="columnheader" >Monday</th> 
					 		 <th role="columnheader" >Tuesday</th> 
					 		 <th role="columnheader" >Wednesday</th>
							 <th role="columnheader" >Thursday</th>
							 <th role="columnheader" >Friday</th>
							 <th role="columnheader" >Saturday</th>
							 <th role="columnheader" >Total</th>
						</tr> 
					</thead> 
					<tbody> 
						@foreach($data as $d)
						<tr style="border-bottom: 1px solid grey;" role="rowgroup" class="spin-details">   
							<td class="text-nowrap" >{{$loop->iteration}}</td>
							<td class="text-nowrap" >{{$d['dj_name']}}</td>
							<td class="text-nowrap" >{{$d['country']}}</td>
							<td class="text-nowrap" >{{$d['city']}}</td> 
							<td>
								@php($count = 0)
								@if(array_key_exists('Sun', json_decode($d['tws'])))
								@foreach($d['tws']['Sun'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							<td>
								@if(array_key_exists('Mon', json_decode($d['tws'])))
								@foreach($d['tws']['Mon'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							<td>
								@if(array_key_exists('Tue', json_decode($d['tws'])))
								@foreach($d['tws']['Tue'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							<td>
								@if(array_key_exists('Wed', json_decode($d['tws'])))
								@foreach($d['tws']['Wed'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							<td>
								@if(array_key_exists('Thu', json_decode($d['tws'])))
								@foreach($d['tws']['Thu'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							<td>
								@if(array_key_exists('Fri', json_decode($d['tws'])))
								@foreach($d['tws']['Fri'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							<td>
								@if(array_key_exists('Sat', json_decode($d['tws'])))
								@foreach($d['tws']['Sat'] as $spin)
									<code>{{ Carbon\Carbon::parse($spin['played_timestamp'])->format('h:i  a') }}</code><br>
									@php($count++)
								@endforeach
								@endif
							</td>
							
							<td>{{$count}}</td>
						</tr>
						@endforeach
					</tbody> 
				</table>
			
		</div>
	</div>
</div>
@endsection
