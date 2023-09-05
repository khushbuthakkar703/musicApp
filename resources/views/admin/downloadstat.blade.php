@extends('layouts.admin')
@section('content')
<div class="container">
	<div class="row">
		<table class="table table-responsive">
			<thead>
				<tr>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Dj Name</td>
					<td>Status</td>
				</tr>
				@foreach($djs as $dj)
					<tr>
						<td>{{$dj->first_name}}</td>
						<td>{{$dj->last_name}}</td>
						<td>{{$dj->dj_name}}</td>
						<td>
							@if($dj->downloaded == 0)
								No
							@elseif($dj->downloaded == 1)
								Windows App
							@elseif($dj->downloaded == 2)
								MAC app
							@endif
						</td>
					</tr>
				@endforeach
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
	<div class="row">
		{{ $djs->links() }}
	</div>
</div>
@endsection