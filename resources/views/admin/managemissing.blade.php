@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
    	<table class="table">
    		<thead>
    			<tr>
    				<th>SN</th>
    				<th>MusicID</th>
    				<th>Title</th>
    				<th>Action</th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($campaignAudios as $ca)
	    			<tr>
	    				<td>{{$loop->iteration}}</td>
	    				<td>{{$ca->id}}</td>
	    				<td>{{$ca->song_title}}</td>
	    				<td>
	    					<a href="/campaignaudio/addfingerprint/{{$ca->id}}" class="btn">
	    						<button>Add to fp</button> 
	    					</a>
	    				</td>
	    			</tr>
	    		@endforeach	
    		</tbody>
    	</table>
    </div>
</div>
@endsection