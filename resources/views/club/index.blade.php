@extends('layouts.admin')
@section('content')
	
	<table class="table">
		@foreach($clubs as $club)
			<tr><td>{{$club->name}}</td></tr>
		@endforeach
	</table>
@endsection