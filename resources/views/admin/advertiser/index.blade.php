@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="widget widget-default widget-fluctuation">
			<header class="widget-header">
            	Advertiser's List
            </header>
            <div class="widget-body">
            	<table class="table">
            		<tr >
            			<th>S.N.</th>
            			<th>Name</th>
            			<th>Refer Percentage</th>
            			<th>Amount Earned</th>
            			<th>Action</th>
            		</tr>
				@foreach($advertisers as $advertiser)
					@if($advertiser->user == null)
						@continue
					@endif
					<tr>
						<form method="POST" action="{{route('advertiser.update.percent')}}">
							<td>{{$loop->iteration}}</td>
							<td>{{$advertiser->name}}</td>
							<input type="hidden" name="id" value="{{$advertiser->id}}">
							<td>
								<input class="form-control" type="number" name="reward_percentage" value="{{$advertiser->reward_percentage}}" max="50" min="0">
							</td>
							<td>${{$advertiser->total_earned}}</td>
							<td>
								<a href="{{route('advertiser.view',[$advertiser->id])}}"><div class="btn btn-success">View</div></a>

								@if($advertiser->user->blocked == "no")
									<a href="{{route('employee.disable',[$advertiser->id])}}"><div class="btn btn-danger">Disable</div></a>
								@else
									<a href="{{route('employee.enable',[$advertiser->id])}}"><div class="btn btn-pink">Enable</div></a>
								@endif

								<input type="submit" class="btn btn-warning" value="Submit">
							</td>
						</form>
					</tr>
				@endforeach

				</table>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New Advertiser
				</button>
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <form method="POST" action="/advertiser/add">
					      <div class="modal-body">
					      		<div class="form-group ">
					      			<input class="form-control input-lg inputBox" name="name" id="name" placeholder="Advertiser's Name" value="" data-validetta="required">
			                    </div>
			                    <div class="form-group ">
					      			<input class="form-control input-lg inputBox" name="email" id="email" placeholder="Advertiser's Email" value="" data-validetta="required,email">
			                    </div>
			                    <div class="form-group ">
					      			<input class="form-control input-lg inputBox" name="email_confirmation" id="email_confirmation" placeholder="Confirm Advertiser's Email" value="" data-validetta="required,equalTo[email]]">
			                    </div>
			                    <div class="form-group ">
					      			<input class="form-control input-lg inputBox" name="username" id="username" placeholder="Advertiser's Username" value="" data-validetta="required">
			                    </div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <input type="submit" class="btn btn-primary" value="Add">
					      </div>
					      </form>
					    </div>
					  </div>
					</div>
			</div>
        </div>
    </div>
</div>
@endsection
