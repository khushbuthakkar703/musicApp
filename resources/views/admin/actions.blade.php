@extends('v2.layouts.layout')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="widget widget-default widget-fluctuation">
			<header class="widget-header">
            	Change DjManager
            </header>
			<div class="widget-body">
				<div class="col-lg-5">
					Choose DJ
				</div>
				<div class="col-lg-5">
					Choose Manager
				</div>
				<form method="post" action="{{route('admin.updatemanager')}}">
					<div class="col-lg-5">
						<select name="djid" type="button"
			                                    class="btn btn-default dropdown-toggle dj-manager" data-toggle="dropdown"
			                                    aria-haspopup="true" aria-expanded="false">
								@foreach($djs as $dj)
									<option value="{{$dj->id}}" manager="{{$dj->invited_by}}">{{$dj->dj_name}}</option>
								@endforeach
						</select>
					</div>
					<div class="col-lg-5">
						<select name="manid" type="button"
			                                    class="btn btn-default dropdown-toggle manager" data-toggle="dropdown"
			                                    aria-haspopup="true" aria-expanded="false">
								@foreach($managers as $manager)
									<option value="{{$manager->user_id}}">{{$manager->first_name}} {{$manager->last_name}}</option>
								@endforeach
						</select>
					</div>
					<div class="col-lg-2">
						<input type="submit" value="Update" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="widget widget-default widget-fluctuation">
			<header class="widget-header">
            	Change Dj Genre
            </header>
			<div class="widget-body">
				<div class="col-lg-5">
					Choose DJ
				</div>
				<div class="col-lg-5">
					Select Genres
				</div>
				<form method="post" action="{{route('admin.updategenre')}}">
					<input type="hidden" name="dj_update_genre" id="dj_update_genre" value="">
					<div class="col-lg-5">
						<select name="dj" type="button"
			                                    class="btn btn-default dropdown-toggle dj" data-toggle="dropdown"
			                                    aria-haspopup="true" aria-expanded="false">
								@foreach($djs as $dj)
									<option value="{{$dj->user_id}}" >{{$dj->dj_name}}</option>
								@endforeach
						</select>
					</div>
					<div class="col-lg-5">
						@foreach($genres as $genre)
							<li class="col-lg-6"><input type="checkbox" name="genre[]" id="{{$genre->id}}" value="{{$genre->id}}"> {{$genre->name}}</li>
						@endforeach
					</div>
					<div class="col-lg-2">
						<input type="submit" value="Update" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
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
								@if($dj->type == 'mobile')
									<option value="{{$dj->id}}" >{{$dj->dj_name}}</option>
								@endif
							@endforeach
					</select>
				</div>
				<div class="col-lg-5 event">

				</div>
				<div class="col-lg-2">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		manager = $('option:selected', this).attr('manager')
		$('.manager').val(manager);
	    $(".dj-manager").on('change', function(data){
			manager = $('option:selected', this).attr('manager')
			$('.manager').val(manager);
		});

	    dj = $( ".dj option:selected" ).val();
	    getGenres(dj)
	    $(".dj").on('change', function(){
	    	//console.log()
			getGenres($(".dj").val())
		});


	    mobile_dj = $( ".mobile-dj option:selected" ).val();
	    getEvent(mobile_dj)
		$(".mobile-dj").on('change', function (){
			getEvent($(".mobile-dj").val())
		})




	});

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

	function getGenres(id){
		$("#dj_update_genre").val(id)
		url = "/admin/action/getgenres/"+id

		for(var i=0; i<50; i++){
				$('#'+i).prop('checked', false);
			}
		$.get(url,function(data){
			for(var i=0; i<data.length; i++){
				$('#'+data[i].music_type).prop('checked', true);
			}
		});

	}
</script>
@endsection
