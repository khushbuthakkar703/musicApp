@php
    $currentUser = auth()->user();
    $role = auth()->user()->role;
    $role=ucwords($role);
@endphp
<!-- Begin Sidebar Menu ----------------------------------------------------------------------------------------------->
<div id="scroll_bar" class="dashboard-drawer scroll_bar_menu mdl-layout__drawer mdl-color--black mdl-color-text--grey-300">
  <!-- Spinstatz Logo -->
  <div class="drawer-logo-container">
    <a href="#"><img class="drawer-logo" src="/images/SpinstatsApplogo.png"></a>
  </div>
  <!-- Spinstatz account header -->

  <header class="drawer-header">
    <!-- Profile Picture -->
    @if($currentUser->profile_picture==='{{ url($currentUser->profile_picture) }}'|| $currentUser->profile_picture==null)
      <form method="POST" id="image-form" action="/dj/profileUpload" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <input type="file" style="visibility:hidden" name="file" id="imgUpload">
          <input type="button" value="Upload Image" class="btn btn-transparent btn-transparent-primary btn-block upload-form" onclick="$('#imgUpload').click();" />
          @if ($errors->has('file'))
            <span class="text-danger">
          <strong>{{ $errors->first('file') }}</strong>
        </span>
          @endif
        </div>
      </form>
    @else
      <form method="POST" id="image-form" action="/dj/profileUpload" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" style="visibility:hidden" name="file" id="imgUpload">
        @if ($errors->has('file'))
          <span class="text-danger">
        <strong>{{ $errors->first('file') }}</strong>
      </span>
        @endif
      </form>
      <div class="container" id="con" style="margin-top:-40px">
        <img src="{{ url($currentUser->profile_picture) }}" id="image" alt="{{$currentUser->username}}" onclick="$('#imgUpload').click();" style="height: 140px;">
        <!-- <img src="img_avatar.png" alt="Avatar" class="image"> -->
        <div class="overlay" onclick="$('#imgUpload').click();">
          <div class="text" style="font-size: small">Change profile picture</div>
        </div>
      </div>
  @endif
  <!-- <a href="/images/profile-picture.jpg"><img src="/images/profile-picture.jpg" class="avatar mx-auto d-block"></a> -->
    <!-- Profile Name -->
    <div><h5 class="mt-5">{{$dj->dj_name}}</h5> </div>

    <!-- Profile Rating -->
    <p style="color: grey;">Earned points: {{$dj->total_spin}}</p>
        <div class="d-flex ratting_diamond">
          @for($k =0; $k<$diamondCount; $k++)
              <span class="widget-statistic-icon fa fa-diamond"></span>
          @endfor
        </div>
  </header>
  <p style="font-size: 19px; font-weight: 500; margin-bottom: 25px !important; color:rgb(132, 255, 255)" class="my-4 mb-0 pl-15">Menu</p>
  <!-- Spinstatz Navigation Menu -->
  <div class="ml-4 mb-4">
    <div class="d-flex {{ request()->segment(2)=='dashboard' ? 'active-sidebar-item' : '' }}">
      <i class="material-icons my-3 mt-4" style="font-size: 20;">home</i><a href="/dj/dashboard" style="color:#FFF; margin-top:17px; margin-left:15px" class="">Dashboard</a>
    </div>
    <!-- <i class="material-icons ml-2 my-2" style="font-size: 20;">account_circle</i> 
    <div class="d-flex {{ request()->segment(2)=='accepted' && request()->segment(3)=='campaign' ? 'active-sidebar-item' : '' }}">
      <i class="material-icons my-3" style="font-size: 20;">clear_all</i><a href="/dj/accepted/campaign" style="color:#FFF;margin-left:15px" class="mt-3">My Videos</a>
    </div>-->

    <!--<div class="d-flex {{ request()->is('/dj/dashboard') ? 'active-sidebar-item' : '' }}">
      <i class="material-icons my-3 ml-1" style="font-size: 20;">playlist_add</i><a href="{{route('crate')}}" style="color:#FFF; margin-left:13px" class="mt-3">Crate</a>
    </div> -->
    <!--<div class="d-flex {{ request()->segment(2)=='inbox' ? 'active-sidebar-item' : '' }}">
      <i class="material-icons my-3" style="font-size: 20;">local_post_office</i><a href="/dj/inbox" style="color:#FFF; margin-left:16px" class="mt-3">Inbox</a>
    </div> -->
    <div class="d-flex {{ request()->segment(2)=='history' ? 'active-sidebar-item' : '' }}">
      <i class="fas fa-clock my-3 ml-1" style="font-size: 17;"></i><a href="/dj/history" style="color:#FFF; margin-left:16px" class="mt-3">History</a>
    </div>

    <div class="d-flex {{ request()->segment(2)=='profile' && request()->segment(3) > 0 ? 'active-sidebar-item' : '' }}">
      <i class="fas fa-user my-3 ml-1" style="font-size: 17;"></i>
      <a href="/dj/profile/{{$djdata->id}}" style="color:#FFF; margin-left:18px" class="mt-3">Profile</a>
    </div>

    <div class="d-flex {{ request()->segment(2)=='profile' && request()->segment(3)=='edit' ? 'active-sidebar-item' : '' }}">
      <i class="material-icons my-3" style="font-size: 20;">settings</i><a href="/dj/profile/edit" style="color:#FFF; margin-left:15px" class="mt-3">Setting</a>
    </div>
	   <div class="d-flex {{ request()->segment(2)=='spin' && request()->segment(3)=='videos' ? 'active-sidebar-item' : '' }}">
        <i class="fas fa-video-camera my-3" style="font-size: 20;"></i>
        <a href="{{route('djearnedvideos')}}" style="color:#FFF; margin-left:15px" class="mt-3">My Videos</a>
    </div>
    <div>&nbsp;<a href="/djlogin/success" class="btn mt-4 float-left add_funds_btn" style="color: rgb(132, 255, 255); border: 1px solid;" role="button">ADD VENUE</a>
	  </div>
    <div>
		
      <p></p>
    </div>


    <div class="side_log" class="d-flex">
      <i class="material-icons my-3" style="font-size: 20;">exit_to_app</i><a href="/logout" style="color:#FFF;margin-left:15px">Logout</a>
    </div>
  </div>
</div>
<style>
  #con {
    position: relative;
    width: 80%;
  }

  #image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 50%;
  }

  .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 15;
    right: 0;
    height: 100%;
    width: 85%;
    opacity: 0;
    transition: .5s ease;
    background-color: #008CBA;
    border-radius: 50%;
  }

  #con:hover .overlay {
    opacity: 1;
  }

  .text {
    color: white;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
  }
  .drawer-header form#image-form input {    width: auto !important;    max-width: 100% !important; }
  div#scroll_bar.scroll_bar_menu{ z-index: 1 !important; }
</style>
<!-- End Sidebar Menu ----------------------------------------------------------------------------------------------->
<script>
  $('#imgUpload').change(function() {
    $('#image-form').submit();
    displayAnimation();
  });
</script>
