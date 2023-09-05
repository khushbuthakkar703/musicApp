@extends('v2.layouts.layout')
@section('content')
	<div class="page-wrapper">
		<table class="table table-striped table-responsive">
			<tr>
				<th>SN</th>
				<th>Campaign Id</th>
				<th>Transaction Id</th>
				<th>Payment Status</th>
				<th>Amount</th>
				<td>Date</td>

			</tr>
		@foreach($deposits as $deposit)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$deposit->campaign_uid}}</td>
				<td>{{$deposit->transaction_id}}</td>
				<td>{{$deposit->payment_status}}</td>
				<td>{{$deposit->amount}}</td>
				<td>{{$deposit->created_at}}</td>
			</tr>
		@endforeach
		</table>
	</div>
@endsection
