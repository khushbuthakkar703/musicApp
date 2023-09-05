@extends('v2.layouts.layout')
@section('content')
<div class="container-fluid">  
	@foreach($users as $user)
	<div class="row">
		<div class="col-md-6 col-xs-12  col-lg-10">
			<div class="widget widget-default">
				<header class="widget-header">{{$user->username}}</header>
				<div class="widget-body table-responsive">
					@if(count($user->campaign) > 0)
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<td height="134"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr>
											<td width="45%" align="left">
												<span style="text-align: left"></span>        
												<span style="text-align: left"></span>        
												<select class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													@foreach($user->campaign as $campaign)
													<option>{{$campaign->song_title}}</option>
													@endforeach
													
												</select>
											</td>
											<td width="13%" rowspan="2" valign="top" style="text-align: center">
												<img src="{{$user->profile_picture}}" alt="{{$user->username}}" width="75" height="72"/></td>
											<td width="18%" style="color: #02A4FF">Contact Name:</td>
											<td width="24%">{{$user->campaign[0]['first_name']}} {{$user->campaign[0]['last_name']}}</td>
										</tr>
										<tr>
											<form method="GET" action="{{route('artistmanager.loginas')}}">
												<input type="hidden" name="userId" value="{{$user->id}}">
											<td rowspan="2" align="left">
												<input type="submit" class="btn btn-success" value="Login">
											</td>
											</form>
											<td style="color: #02A4FF">Contact Phone:</td>
											<td>{{$user->campaign[0]['phone']}}</td>
										</tr>
										<tr>
											<td height="40">&nbsp;</td>
											<td style="color: #02A4FF">Contact Email:</td>
											<td>{{$user->campaign[0]['email']}}</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				@else
				<form method="GET" action="{{route('artistmanager.loginas')}}">
					<input type="hidden" name="userId" value="{{$user->id}}">
						<td rowspan="2" align="left">
						<input type="submit" class="btn btn-success" value="Login">
					</td>
				</form>
				@endif
			</div>
		</div>
	</div>
</div>
@endforeach
</div>
@endsection