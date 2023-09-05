@extends('layouts.djmanager')

@section('content')
<div class="" style="padding: 10px;"><h2>Notifications</h2></div>
<div class="container">
	<div class="row">
		<table class="table table-responsive">
			<thead>
				<tr>
					<td>Sender</td>
					<td>Receiver</td>
					<td>Subject</td>
					<td>Message</td>
					<td>Status</td>
				</tr>
				
				 @foreach($notifications as $notification)
					<tr>
						<td>{{$notification->username}}</td>
						<td>{{$name}}</td>
						<td><a href="{{ $notification->href }} ">{{$notification->subject}}</a></td>
						<td>{{$notification->message}}</td>
						<td>
							@if($notification->is_shown == 0) 
								 unread 
							 @else 
								read
							
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
		{!! $notifications->links() !!}
	</div>
</div>
@endsection
