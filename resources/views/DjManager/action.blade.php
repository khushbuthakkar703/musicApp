@extends('layouts.djmanager')
@section('content')
<div class="container-fluid">
	<!-- <div class="row">
		<div class="widget widget-default widget-fluctuation">
			<header class="widget-header">
				Manage Mobile Dj Events
			</header>
			<div class="widget-body">
				<div class="col-lg-5">
					Choose DJ
				</div>
				<div class="col-lg-5">
					Manage Event
				</div>
				
				<div class="col-lg-5">
					<select name="mobile-dj" type="button"
					class="btn btn-default dropdown-toggle mobile-dj" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					@foreach($djs as $dj)
					<option value="{{$dj->id}}" >{{$dj->dj_name}}</option>
					@endforeach
					</select>
				</div>
				<div class="col-lg-5 event">

				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</div>
	</div> -->


	<div class="row">
		<div class="widget widget-default widget-fluctuation">
			<header class="widget-header">
				All Comming Events
			</header>
			<div class="widget-body">
				<table class="table">
					<tr>
						<th>SN</th>
						<th>Event Name</th>
						<th>Dj Name</th>
						<th>Event Start Time</th>
						<th>Event End Time</th>
						<th>Event Status</th>
						<th>Action</th>
					</tr>

					@foreach($events as $event)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$event->event}}</td>
							<td>{{$event->dj_name}}</td>
							<td>{{$event->start_time}}</td>
							<td>{{$event->end_time}}</td>
							<td>{{$event->status}}</td>
							<td>
								<a href="/dj/mobile/events?id={{$event->dj_id}}">View this dj events 
								</a>
							</td>
						</tr>
					@endforeach

					
				</table>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		mobile_dj = $( ".mobile-dj option:selected" ).val();
		getEvent(mobile_dj)
		$(".mobile-dj").on('change', function (){
			getEvent($(".mobile-dj").val())
		})
	})

	function getEvent(id){
		
		url = "/admin/action/getevent/"+id
		console.log(url)
		$.get(url,function(data){
			console.log(data)
			$('.event').html("");
			for(var i=0; i<data.length; i++){
				$('.event').append('<li>'
					+data[i]['name']
					+'</li>')
				
			}
			$('.event').append('<li>'
				+'<a href="/dj/mobile/events?id='+id+'">View All events </a>'
				+'</li>')
		});


	}
</script>

@endsection