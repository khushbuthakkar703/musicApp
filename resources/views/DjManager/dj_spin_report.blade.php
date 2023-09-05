@extends('layouts.djmanager')
@section('content')

<style>
    .list-group-1 {
        display: none;
    }

</style>
<header class="page-header">
   
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="margin-top-0">DJ Management Console <small>Edit DJ information and monitor activity using this page.</small></h4>
        </div>
    </div>
    <div class="row">
       <div class="col-sm-12 col-lg-4">
              
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="profile-details">
                                                    <div class="profile-details-profile-picture">
                                                        <img src="/{{$djuser->profile_picture}}" >
                                                    </div>
                                                    <div class="profile-details-info">
                                                        <h2 class="profile-details-info-name">{{$djid->dj_name}} </h2>
                                                        <p class="profile-details-info-summary">{{$djid->description}}</p>
                                                        <ul class="profile-details-info-contact-list">
                                                            <li class="profile-details-info-contact-list-item">
                                                                <a href="mailto:{{$djuser->email}}">
                                                                    <span class="fa fa-envelope profile-details-info-contact-list-item-icon"></span>{{$djuser->email}}
                                                                </a>
                                                            </li>
                                                            <li class="profile-details-info-contact-list-item"><span
                                                                        class="fa fa-phone profile-details-info-contact-list-item-icon"></span>
                                                                {{$djid->phone_number}}
                                                            </li>
                                                            <li class="profile-details-info-contact-list-item"><a
                                                                        href="#">
                                                                    <span class="fa fa-twitter profile-details-info-contact-list-item-icon"></span>{{$djid->twitter}}</a>
                                                            </li>
                                                        </ul>
														  <span class="">
                                    <a href="/djmanager/dj/edit/{{$djid->id or 'edit manager error'}}"> 
                                        <button class="btn btn-transparent btn-xs">
                                            <span class="fa fa-pencil"></span> 
                                            <span class="hidden-xs hidden-sm hidden-md">Edit</span>
                                        </button> 
                                    </a>
                                    </span>
                                                    </div>
                                                </div>
												
                                            </div>
											
                                        </div>
		 <td width="20%" height="117">
                                                    <div class="widget widget-statistic-mini widget-success">
                                                        <div class="widget-statistic-body">
                                                            <span class="widget-statistic-value">Total Spins / {{$totalspins}}</span>
                                                            <span class="widget-statistic-icon fa fa-diamond"></span>
                                                        </div>
                                                    </div>
                                                </td>
    </div>
	<div class="col-lg-4">
            <div class="widget widget-statistic widget-default">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center"> <div class="btn btn-transparent btn-transparent-danger btn-xs" style="text-align: center">
                                    @if($djuser->blocked =='no')
                                        <button class="btn btn-success btn-xs verified" value="{{$djid->id}}"> <span class="fa fa-check"></span>Verified</button>
                                    @elseif($djuser->blocked =='yes')
                                        <button class="btn btn-transparent btn-transparent-danger btn-xs not-verified" value="{{$djid->id}}"> <span class="fa fa-eject"></span> Not Verified</button>
                                    @endif
          					    </div></td>
    </tr>
  </tbody>
</table>
				<header class="widget-statistic-header">DJ Information  
         
     </header>
														
				 <tr>
                                                <td>
                                                    <div class="panel panel-default">
                                                       
                                                        <table class="table">
                                                          <tbody>
                                                            <tr>
                                                                <th align="left">Name</th>
                                                                <td>{{$djid->first_name." ".$djid->last_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Genre</th>
                                                                <td>
                                                                    @foreach( $genres as $genre)
                                                                        {{$genre->name}} &nbsp
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Software</th>
                                                                <td>{{$djid->software}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Coalition Name</th>
                                                                <td>{{$manager->company_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2"><a href="/djmanagers/messages/compose"
                                                                                   class="btn btn-block btn-success"><span
                                                                                class="fa fa-paper-plane"></span>
                                                                        Message DJ</a>
                                                                </th>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
              </tr>
            </div>
        </div>
		<div class="col-lg-4">
            <div class="widget widget-statistic widget-default">
                <header class="widget-statistic-header">Club Information</header>
                
            <div>
                        <div class="row">
                          <div class="col-xs-12">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                              <tbody>
                                @if(count($clubs) > 0)
                                <tr>
                                  <td>
                                    @for($i = 1; $i <= count($clubs); $i++)
                                      <div class="btn-group" role="group" id="tab{{$i}}">
                                        <button type="button" class="btn btn-default" onclick="openDetails({{$i}})">Club {{$i}}</button>
                                      </div>
                                    @endfor
                        
                                </td>
                                </tr>
                                @else
                                    <div class="btn-group" role="group" id="tab">
                                    <button type="button" class="btn btn-default" >No Club</button>
                                  </div> 
                                @endif
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                @if(count($clubs) > 0)        
                    @foreach($clubs as $club)
                    <ul class="list-group list-group-1" id= "details{{$loop->iteration}}">
                        <li class="list-group-item"><strong>Prime Time:</strong> <code>{{$club->prime_time}}</code></li>
                        <li class="list-group-item"><strong>Address: </strong>{{$club->address}}</li>
                        <li class="list-group-item"><strong>Country: </strong>{{$club->country}}</li>
                        <li class="list-group-item"><strong>Location: </strong> {{$club->city}}, {{$club->state}}</li>
                        <li class="list-group-item"><strong><strong>Capacity:</strong> </strong>{{$club->capacity}}</li>
                        <li class="list-group-item"><strong>Contact: </strong>{{$club->contact}}</li>
                        <li class="list-group-item"><strong>Phone: </strong>{{$club->phone_no}}</li>
                    </ul>
                   @endforeach 
                @else
                   <ul class="list-group" id= "details">
                          <li class="list-group-item"><strong>Prime Time:</strong> </li>
                          <li class="list-group-item"><strong>Address: </strong></li>
                         <li class="list-group-item"><strong>Country: </strong></li>
                        <li class="list-group-item"><strong>Location: </strong></li>
                        <li class="list-group-item"><strong><strong>Capacity:</strong> </strong></li>
                        <li class="list-group-item"><strong>Contact: </strong></li>
                        <li class="list-group-item"><strong>Phone: </strong></li>
                    </ul>
                @endif
            </div>
                </div>
            </div>
    
<div class="widget widget-default">

        <div class="widget-body table-responsive">
                    <table class="table table-striped">
                <thead>
                            <tr>
                                 <th class="hidden-xs hidden-sm">SN</th>
                                <th>Artist Name</th>
                                <th>Song Title</th>
                                 <th class="hidden-xs hidden-sm">Label</th>
                                 <th class="hidden-xs hidden-sm">Genre</th>
                                <th>TW</th>
                                 <th class="hidden-xs hidden-sm" text-right">LW</th>
                                <th class="text-right">Total Spins</th>
                            </tr>
                        </thead>
                <tbody>
                <?php $i = 0 ?>
                @foreach($jsonrecords as $data)
                    <?php $i++ ?>
                    <tr>
                         <th class="hidden-xs hidden-sm" th scope="row">{{ $i}}</th>
                        <td>
                        {{ $data['music']->artist_name }}
                        <td>
                            {{ $data['music']->song_title }}
                        </td>
                         <td class="hidden-xs hidden-sm">
                            {{ $data['label'] }}
                        </td>
                       <td class="hidden-xs hidden-sm">
                            @php($gen =  json_decode($data['music']->genre))
                            @foreach($gen as $g)
                                {{ \App\MusicType::find($g)->name }}
                            @endforeach    
                        </td>

                        <td>
                            <a href="/djmanager/{{$djid->user_id}}/weekly/0"> {{ $data['weektotal'] }} </a>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <a href="/djmanager/{{$djid->user_id}}/weekly/1">{{ $data['last_week_total'] }} </a>
                        </td>
                        <td>
                            {{ $data['played_count']  }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>    

</div>

    </header>
    



<script type="text/javascript">
    tabcontent = document.getElementsByClassName("list-group");
    document.getElementById("details1").style.display = "block";

    function openDetails(id){
        
        for (var i = tabcontent.length-1; i >= 0; i--) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById("details"+ id).style.display = "block";
        //console.log("details opened", id)

    }

</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click',".verified",function(){
            console.log(this.value, "verified clicked")
            var btn = $(this);
            
            $.ajax({
                type: "GET",
                url: "/djmanager/manager/block/"+this.value,

                success: function(result) {
                    if(result.response == 'success'){
                        btn.prop('disabled',true) 
                        alert("Successfully unVerified")
                    }
                    else
                        alert("Unverification failed")

                },
                error: function(result) {
                    alert("failed")
                }
            });
        });
		
		$(document).on('click',".not-verified",function(){
            console.log(this.value, "not verified clicked")
            var btn = $(this);
            $.ajax({
                type: "GET",
                url: "/djmanager/manager/unblock/"+this.value,

                success: function(result) {
                    if(result.response == 'success'){
                        btn.prop('disabled',true)
                        alert("Successfully Verified")
                    }else{
                        alert("Verification failed")
                    }

                },
                error: function(result) {
                    alert("failed")
                }
            });
        });
    });
</script>
@endsection


