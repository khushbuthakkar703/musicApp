<header class="drawer-header">
    <!-- Profile Picture -->
    @if(auth()->user()->profile_picture==='{{ url(auth()->user()->profile_picture) }}'|| auth()->user()->profile_picture==null)
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
        <img src="{{ url(auth()->user()->profile_picture) }}" id="image" alt="{{auth()->user()->username}}" onclick="$('#imgUpload').click();" style="height: 140px;">
        <!-- <img src="img_avatar.png" alt="Avatar" class="image"> -->
        <div class="overlay" onclick="$('#imgUpload').click();">
            <div class="text" style="font-size: small">Change profile picture</div>
        </div>
    </div>
    @endif

    @php
        $djdata = auth()->user()->dj()->first()
    @endphp
    <!-- <a href="/images/profile-picture.jpg"><img src="/images/profile-picture.jpg" class="avatar mx-auto d-block"></a> -->
    <!-- Profile Name -->
    <div>
  <h5 class="mt-5">{{$djdata->dj_name}}</h5></div>

    <!-- Profile Rating -->
    <p style="color: grey;">Earned points: {{$djdata->total_spin}}</p>
    <div class="d-flex ratting_diamond">
        @for($k =0; $k< $djdata->total_spin/1000+1; $k++)
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

    <div class="d-flex {{ request()->is('/dj/dashboard') ? 'active-sidebar-item' : '' }}">
        <i class="material-icons my-3 ml-1" style="font-size: 20;">playlist_add</i><a href="{{route('crate')}}" style="color:#FFF; margin-left:13px" class="mt-3">Crate</a>
    </div>
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

    <div>
        <p></p>
    </div>


    <div class="side_log" class="d-flex">
        <i class="material-icons my-3" style="font-size: 20;">exit_to_app</i><a href="/logout" style="color:#FFF;margin-left:15px">Logout</a>
    </div>
</div>
