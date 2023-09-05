@php($currentUser = Auth::user())
@extends('layouts.' .$layout)

@section('content')
<link href="{{asset('/css/validetta.css')}}" type="text/css" rel="stylesheet"/>
<title>SpinStatz | Events</title>
    <div class="container-fluid">
        <div class="row">
            <table class="table">
            	<thead>
            		<tr>
            			<th>SN</th>
            			<th>Event Name</th>
            			<th>Start Time</th>
            			<th>End Time</th>
            			
            			<th>State</th>
            			<th>City</th>
            			<th>Address</th>
            			<th rowspan="2">Estimated Mass</th>
            			<th>Contact Name</th>
            			<th>Contact Number</th>
            			<th>Website</th>
            			<th>Status</th>
            			<th colspan="2">Action</th>

            		</tr>
            	</thead>
            	<tbody>
            		@foreach($djEvents as $event)
            		<tr>
            			@php
            				$city = \App\City::find($event->city_id);
            				$state = $city->state()->first();
            			@endphp
            			<td>{{$loop->iteration}}</td>
            			<td>{{$event->name}}</td>
            			<td>{{$event->start_time}}</td>
            			<td>{{$event->end_time}}</td>
            			
            			<td>{{$state->name}}</td>
            			<td>{{$city->name}}</td>
            			<td>{{$event->address}}</td>
            			<td>{{$event->estimated_attendance}}</td>
            			<td>{{$event->contact_name}}</td>
            			<td>{{$event->contact_number}}</td>
            			<td>{{$event->website_url}}</td>
            			<td>
                            @if($currentUser->role === 'admin' || $currentUser->role === 'djmanager')
                                <select class="btn btn-default dropdown-toggle status" name="status" id="{{$event->id}}" type="button">
                                    <option @if($event->status == "pending") selected @endif value="Pending">Pending</option>
                                    <option @if($event->status == "approved") selected @endif value="approved">Approved</option>
                                    <option @if($event->status == "completed") selected @endif value="completed">Completed</option>
                                </select>
                            @else
                                 {{$event->status}}   
                            @endif     
                        </td>
            			<td class="form-inline">
            				
                                <a href="/dj/events/delete/{{$event->id}}"><button type="button" class="form-control btn-danger"  >Delete</button></a>
                            
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
            <!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			  Add New Event
			</button>
		</div>
     </div>

     <div id="myModal" class="modal fade" role="dialog">
     	<div class="modal-dialog">

	    <!-- Modal content-->
	    <form method="post" action="{{route('add.event')}}" id="form">
		   <?php echo Form::token(); ?>
		   <br> <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h5 class="modal-title">Add Event</h5>
		      </div>
		      <input type="hidden" name="dj_id" value="{{$dj->id}}">
		      <div class="modal-body">
		        <div class="form-group">
		        	<input type="text" class="form-control input-lg" name="name" placeholder="Event Name/Title" data-validetta="required">
	            </div>
	            
	            <div class="form-group">
		        	<input type="number" class="form-control input-lg" name="estimated_attendance" placeholder="Estimated Attendance" data-validetta="required">
	             <div class="align-center"><small>Estimated Attendance</small>
                        </div>
			</div>
		   
	            
	            
	            <div class="form-group">
	                <div class='input-group date' id='datetimepicker1'>
	                    <input type='text' class="form-control" name="start_time" placeholder="Start Time" data-validetta="required"/>
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>
		        

		        
	            <div class="form-group">
	                <div class='input-group date' id='datetimepicker2'>
	                    <input type='text' class="form-control" name="end_time" placeholder="Event Time" data-validetta="required" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>


	            <div class="form-group" role="group">
                           <select id="btnGroupVerticalDrop1 " type="button" class="form-control input-lg countryOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-validetta="required">
                          </select>
                          <div><small>Choose Your Country</small>
                        </div>
                      
                      </div>

                        <div class="form-group" role="group">
                         <select id="btnGroupVerticalDrop1 " type="button" class="form-control input-lg stateOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-validetta="required">
                          </select>
                          <div><small>Choose Your State</small>
                        </div>
                        
                      </div>
                        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                       <select id="btnGroupVerticalDrop1 " type="button" class="form-control input-lg cityOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="city_id" data-validetta="required">
                            <option></option>
                          </select>
                          <div class="align-center"><small>Choose Your City</small>
                        </div>

                        @if($errors->has('city'))
                            <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                        @endif
		        <div class="form-group">
		        	<input type="text" class="form-control input-lg" name="address" placeholder="Address" data-validetta="required">
	            </div>

	            <div class="form-group">
		        	<input type="text" class="form-control input-lg" name="contact_name" placeholder="Contact Name" data-validetta="required">
	            </div>

	            <div class="form-group">
		        	<input type="text" class="form-control input-lg" name="contact_number" placeholder="Contact Number" data-validetta="required">
	            </div>
	            		  
	            <div class="form-group">
		        	<input type="text" class="form-control input-lg" name="website_url" placeholder="Example: www.event.com" data-validetta="required">
	            <div class="align-center"><small>Event Link</small>
                </div>
		    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <input type="submit" class="btn btn-success" value="Add">
		      </div>
		    </div>
		</form>

	  </div>
</div>
<link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('/js/validetta.js')}}"></script>
<script type="text/javascript">
    $('#form').validetta();
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            use24hours: false,
            showMeridian: true,
            //format: 'yyyy-mm-dd hh:ii'
            //format: 'dd/MM/yyyy hh:mm:ss aa',

        });
        $('#datetimepicker2').datetimepicker({
        	use24hours: false,
            showMeridian: true,
            //format: 'dd MM yyyy hh:ii',
        });

        $('.status').on('change', function(data){
            url = "/admin/mobiledj/event/update/"+this.id+"/"+this.value

            $.get(url, function(){

            })

        });
    });
</script>
<script src="/js/locationchooser.js"></script>
<style type="text/css">
    legend {
        color: white;
    }
</style>

@endsection
