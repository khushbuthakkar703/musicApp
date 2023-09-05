@extends('layouts.admin')
@section('content')
<div class="container">
	<div class="widget">
	<div class="table-responsive">
		<table  class="table tbl-paginate table-hover table-condensed">
	        <thead>
	            <tr>
	                <th >S.N</th>
	                <th >Name</th>
	                <th >Djname</th>
	                <th >Current Balance</th>
	                <th >Requested Amount</th>
	                <th >Total Spin</th>
	                <th colspan="4">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($wrs as $wr)
	            <tr>
	            	<td>{{$loop->iteration}}</td>
	            	<td>{{$wr->first_name ." ".$wr->last_name}}</td>
	            	<td>{{$wr->dj_name}}</td>
	            	<td>{{$wr->points_earned}}</td>
	            	<td>{{$wr->request_amount}}</td>
	            	<td>{{$wr->total_spin}}</td>
	            	<td>
	            		<form method="post" action="{{ route('payout') }}">
	            			{{ csrf_field() }}
	            			<input type="hidden" name="id" value="{{$wr->id}}">
	            			<!-- <input type="hidden" name="amount" value="{{$wr->request_amount}}">
	            			<input type="hidden" name="email" value="{{$wr->paypal_email}}"> -->
	            			<input type="submit" value="Pay Now" class="btn btn-danger">
	            		</form>
	            	</td>
	            	<td>
	            		<a href="/payments/paypal/decline/{{$wr->id}}" class="btn btn-default">Decline</a>
	            	</td>
	            	<td>
	            		<a href="/payments/paypal/manual/{{$wr->id}}" class="btn btn-default">Paid Manually</a>
	            	</td>

                    <td>
                        <a href="/admin/preview/{{$wr->id}}" class="btn btn-default">Preview</a>
                    </td>

	            </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
</div>
    <div>
	    <a href="#" class="paginate" id="previous">Previous</a> |
	    <a href="#" class="paginate" id="next">Next</a>
	</div>
</div>

<div class="container">
	<div class="widget">
	<div class="table-responsive">
		<table  class="table tbl-paginate table-hover table-condensed">
	        <thead>
	            <tr>
	                <th >S.N</th>
	                <th >Name</th>
	                <th >Current Balance</th>
	                <th >Requested Amount</th>
	                <th >Total Spin</th>
	                <th colspan="3">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($wrs_advertiser as $wr)
	            <tr>
	            	<td>{{$loop->iteration}}</td>
	            	<td>{{$wr->name}}</td>
	            	<td>{{$wr->points_earned}}</td>
	            	<td>{{$wr->request_amount}}</td>

	            	<td>
	            		{{ route('payout') }}
	            		<form method="post" action="{{ route('payout') }}">
	            			{{ csrf_field() }}
	            			<input type="hidden" name="id" value="{{$wr->id}}">
	            			<!-- <input type="hidden" name="amount" value="{{$wr->request_amount}}">
	            			<input type="hidden" name="email" value="{{$wr->paypal_email}}"> -->
	            			<input type="submit" value="Pay Now" class="btn btn-danger">
	            		</form>
	            	</td>
	            	<td>
	            		<a href="/payments/paypal/decline/{{$wr->id}}" class="btn btn-default">Decline</a>
	            	</td>
	            	<td>
	            		<a href="/payments/paypal/manual/{{$wr->id}}" class="btn btn-default">Paid Manually</a>
	            	</td>

	            </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
</div>
    <div>
	    <a href="#" class="paginate" id="previous">Previous</a> |
	    <a href="#" class="paginate" id="next">Next</a>
	</div>
</div>
@endsection
<script>window.jQuery || document.write('<script src="/js/jquery-1.12.3.min.js"><\/script>')</script>
<script src="/js/paginate.js"></script>
