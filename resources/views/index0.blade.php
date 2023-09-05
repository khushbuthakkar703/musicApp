@extends('layouts.app')
<script src="{{ asset('js/app.js') }}"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
@section('content')
<div class="dashboard-content-outer">
    <section>
        <div class="col-md-9">

            <div class="col-xs-12 col-md-12 p0 mb20">
                <a href="edit-hostel-profile.html" class=" btn-orange pull-right">
                    <i class="fa fa-pencil " aria-hidden="true"></i> Edit Profile

                </a>
            </div>

            <div id="institution-general-details" class="dashboard-content panel panel-default ">
                    <div class="panel_custom_heading_organge">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        General Details
                    </div>


                <div class="panel-body" style="padding: 10px 0;">


                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">Username : </span>
                                    <span>{{$user->username}}</span>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">Password : </span>
                                    <span>********</span>

                                </p>
                            </div>

                            <div class="col-md-12">
                                    <p>
                                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                                        <span class="fw7 pl5">Hostel Name : </span>
                                        <span>{{$hostel->name}}</span>

                                    </p>
                                </div>

                            <div class="col-md-6">
                                    <p>
                                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                                        <span class="fw7 pl5">Country : </span>
                                        <span>{{$coun->title}}</span>

                                    </p>
                                </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">Sate : </span>
                                    <span> {{$state->title}}</span>

                                </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">City : </span>
                                    <span> Kathmandu</span>

                                </p>
                            </div>

                            <div class="col-md-6">
                            <p>
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span class="fw7 pl5">Address : </span>
                                <span> {{$hostel->address}}</span>

                            </p>
                        </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">
                                         Landline 1 :
                                    </span>
                                    <span> {{$hostel->landline1}}</span>
                                </p>
                            </div>

                            <div class="col-md-6">
                            <p>
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">
                                         Landline 2 :
                                    </span>
                                <span> {{$hostel->landline2}}</span>
                            </p>
                        </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                      <span class="fw7 pl5">Email :</span>
                                    <span> {{$hostel -> website}}</span>
                                </p>
                            </div>

                             <div class="col-md-6">
                            <p>
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                        <span class="fw7 pl5">
                                             Mobile :
                                        </span>
                                <span> {{$hostel->contact_no}}</span>
                            </p>
                        </div>

                            <div class="col-md-6">
                                    <p>
                                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Website :
                                            </span>
                                        <span>{{$hostel -> website}}</span>
                                    </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Total Rooms :
                                            </span>
                                    <span>{{$hostel->total_room}}</span>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="fw7 pl5">Gender :</span>

                                    @if($hostel->gender == 0)
                                     <span> Male</span>
                                     @else
                                     <span> Female</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Logo :
                                            </span>
                                    <span> xyxcxvs.jpg</span>
                                </p>
                            </div>

                    </div>

                <div class="panel-body inst-extra-details" style="padding-top: 0;">


                    <div class="panel-group" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default" style="border-radius: 0;">
                            <div class="panel-heading" role="tab" >
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#hostGen1" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Gallery
                                    </h4>
                                </a>
                            </div>
                            <div id="hostGen1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" >

                                    <div class="row">

                                        <div class="col-md-6">
                                            <p>
                                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Image 1 :
                                            </span>
                                                <span> xyxcxvs.jpg</span>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <p>
                                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Image 2 :
                                            </span>
                                                <span> xyxcxvs.jpg</span>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <p>
                                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Image 3 :
                                            </span>
                                                <span> xyxcxvs.jpg</span>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <p>
                                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Image 4 :
                                            </span>
                                                <span> xyxcxvs.jpg</span>
                                            </p>
                                        </div>

                                        <div class="col-md-6">
                                            <p>
                                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span class="fw7 pl5">
                                                 Image 5 :
                                            </span>
                                                <span> xyxcxvs.jpg</span>
                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- accordion -->


                    <div class="panel-group" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default" style="border-radius: 0;">
                            <div class="panel-heading" role="tab" >
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#hostGen2" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Nearby Institutions
                                    </h4>
                                </a>
                            </div>
                            <div id="hostGen2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" >

                                    <div class="row">

                                        <div class="info">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> Nearby Institutions </div>
                                                <ul class="inst-list-tutor">

                                                  @foreach($nearbyInstitutions as $nearbyInstitution)

                                                     @if(in_array($nearbyInstitution->id,$selectedNearbyInstitutionsArray))

                                                     <a href="{{$nearbyInstitution->id}}">
                                                         <li>
                                                             {{$nearbyInstitution->name}}
                                                         </li>
                                                     </a>

                                                     @else

                                                         <option value="{{$nearbyInstitution->id}}" name="nearbyInstitution[]" >{{$nearbyInstitution->name}}</option>
                                                     @endif
                                                 @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- accordion -->

                    <div class="panel-group" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default" style="border-radius: 0;">
                            <div class="panel-heading" role="tab" >
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#hostGen3" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Facilities
                                    </h4>
                                </a>
                            </div>
                            <div id="hostGen3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" >

                                    <div class="row">

                                        <div class="info col-md-4">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> TV </div> </div>
                                        </div>
                                        <div class="info col-md-4">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> Breakfast </div> </div>
                                        </div>
                                        <div class="info col-md-4">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> Internet </div> </div>
                                        </div>
                                        <div class="info col-md-4">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> Clothes Washing </div> </div>
                                        </div>
                                        <div class="info col-md-4">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> Gizzer </div> </div>
                                        </div>
                                        <div class="info col-md-4">
                                            <div class="item_info">
                                                <div class="llabel"> <i class="home icon"></i> Dinner </div> </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- accordion -->

                    <div class="panel-group" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default" style="border-radius: 0;">
                            <div class="panel-heading" role="tab" >
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#hostGen4" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        Description
                                    </h4>
                                </a>
                            </div>
                            <div id="hostGen4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" >

                                    <div class="row">

                                        <div class="info-desc ">

                                            <div class="item_info description" >
                                                <p>
                                                    The mission of the undergraduate program in Aeronautics and Astronautics Engineering is to provide students with the principles and techniques necessary for success and leadership in the conception, design, implementation, and operation of aerospace and related engineering systems.
                                                </p>

                                                <p>
                                                    The mission of the undergraduate program in Aeronautics and Astronautics Engineering is to provide students with the principles and techniques necessary for success and leadership in the conception, design, implementation, and operation of aerospace and related engineering systems.
                                                </p>

                                                <p>
                                                    The mission of the undergraduate program in Aeronautics and Astronautics Engineering is to provide students with the principles and techniques necessary for success and leadership in the conception, design, implementation, and operation of aerospace and related engineering systems.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- accordion -->

                 </div>
            </div>
            <!-- personal details -->


        </div>
    </section>
</div>

</div><!--row -->
</div><!--container -->
</div><!-- mainContent -->
    
@endsection
