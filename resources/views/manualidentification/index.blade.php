@extends('layouts.keyer')

@section('content')
	<link rel="stylesheet" href="/css/datatables.min.css">
    <script src="/js/jquery-1.12.3.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    
    <div class="page-wrapper">
    <header class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h5 class="page-header-heading"><span class="typcn typcn-clipboard page-header-heading-icon">

                        </span> Manual Identification</h5>
                </div>
            </div>
        </div>
    </header>

        <div class="row">
           @php
           	$message = json_decode($spin->message, true)
           @endphp


           <div class="widget-body">
                <video width="90%" height="60%" controls autoplay="true">
                  
                  <source src="http://spinstatz.org/records/{{$message['payload']['video_link']}}" type="video/webm">
                Your browser does not support the video tag.
                </video> 

           </div>
       </div>
       <div class="row">	
            <div class="widget-body"> 
            	<table class="table table-strip music-list">
            		<tr>
            			<th>S.N.</th>
            			<th>Song Name</th>
            			<th>Action</th>
            		</tr>
            	
	            	
            		@foreach($musics as $music)
            			<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$music->song_title}}</td>
            				<td>{{$music->id}}</td>
            			</tr>
            		@endforeach
	            	
            	</table>
            </div>
            <script type="text/javascript">
            	$(function () {
            		var table = $('.music-list').DataTable({
            			"pagingType": "full_numbers",
            			"searching": true,
            		});
            	});
            </script>
        </div>
    </div>

@endsection