@php
    $currentUser = auth()->user();
    $role = auth()->user()->role;
    $role=ucwords($role);
@endphp

<!-- Begin Sidebar Menu ----------------------------------------------------------------------------------------------->
<div id="scroll_bar" class="dashboard-drawer mdl-layout__drawer mdl-color--black mdl-color-text--grey-300" style="overflow-x: hidden;">
    <!-- Spinstatz Logo -->
    <div class="drawer-logo-container mb-5">
        <!-- <a href="#"><img class="drawer-logo" src="/images/SpinstatsApplogo.png"></a> -->
    </div>
    <!-- Spinstatz account header -->

    <header class="drawer-header">
        <!-- Profile Picture -->
        @if($currentUser->profile_picture==='{{ url($currentUser->profile_picture) }}'|| $currentUser->profile_picture==null)
            <form method="POST" id="image-form" action="/campaign/profileUpload" enctype="multipart/form-data">
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
            <form method="POST" id="image-form" action="/campaign/profileUpload" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" style="visibility:hidden" name="file" id="imgUpload">
                @if ($errors->has('file'))
                    <span class="text-danger">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
                @endif
            </form>
            <div class="container" style="margin-top:-40px">
                <img src="{{ url($currentUser->profile_picture) }}" id="image" alt="{{$currentUser->username}}" onclick="$('#imgUpload').click();">
                <!-- <img src="img_avatar.png" alt="Avatar" class="image"> -->
                <div class="overlay" onclick="$('#imgUpload').click();">
                    <div class="text" style="font-size: small">Change profile picture</div>
                </div>
            </div>
    @endif
    <!-- <a href="/images/profile-picture.jpg"><img src="/images/profile-picture.jpg" class="avatar mx-auto d-block"></a> -->
        <!-- Profile Name -->
        @php
            $campaigndata = auth()->user()->musicCampaign()->first()
        @endphp
        <h5 class="mt-5" style="text-align: center;">{{ @$campaigndata->first_name.' '.@$campaigndata->last_name }} </h5>

        <!-- Profile Rating -->
        <!-- <p style="color: grey;">Your rating:</p>
        <span class="mt-0" style="font-weight: bold;">4.7</span> -->
    </header>
    <br><br>
    <!-- Spinstatz Navigation Menu -->
    <div class="ml-4 mb-4">
        <div class="d-flex {{ request()->segment(2)=='dashboard' ? 'active-sidebar-item' : '' }}">
            <i class="material-icons my-4 mt-4" style="font-size: 20;">home</i><a href="/campaign/dashboard" style="color:#FFF; margin-top:18px; margin-left:15px" class="">Dashboard</a>
        </div>
        <!-- <i class="material-icons ml-2 my-3" style="font-size: 25;">account_circle</i> -->
       <!-- <div class="d-flex">
            <img src="/images/campaigns.png" alt="" width="17px" height="17px" class="my-3 ml-1"><a href="#" style="color:#FFF; margin-top:10px; margin-left:15px">Campaigns</a>
        </div>-->
        <div class="d-flex {{ request()->segment(2)=='spin' ? 'active-sidebar-item' : '' }}"> 
            <i class="material-icons my-3" style="font-size: 20;">videocam</i><a href="spin/videosv2" style="color:#FFF; margin-left:8px" class="mt-3 ml-4">Videoproof</a>
        </div>
       
        <div class="d-flex">
            <i class="fas fa-user my-3 ml-1" style="font-size: 17px;"></i>
            <a href="" style="color:#FFF; margin-left:18px" class="mt-3">Profile</a>
        </div>
        <div class="d-flex {{ request()->segment(2)=='edit' ? 'active-sidebar-item' : '' }}">
            <i class="material-icons my-3" style="font-size: 20;">settings</i><a href="/campaign/edit/profile" style="color:#FFF; margin-left:7px" class="mt-3 ml-4">Settings</a>
        </div>
		 <div class="d-flex {{ request()->segment(1)=='advertisement' ? 'active-sidebar-item' : '' }}">
            <img src="/images/ver.png" alt="" width="15px" height="15px" class="my-3 ml-1"><a href="/advertisement/new/create" style="color:#FFF; margin-left:17px" class="mt-3">Promote</a>
        </div>
		
		<br><br><br>
		<div class="d-flex mt-4">
			<a style="background: #84ffff; border: 1px solid #84ffff;color: #000;border-radius: 20px;width: 189px;height: 45px;" href="#" class="btn mt-5 float-left" data-toggle="modal" id="addCampaign" data-target="#addCampaignModal"><span class="plus-sign">+</span> <span class="btn-add-campaign">New campaign</span></a>
			</div>
        <div class="side_log" class="d-flex">
            <i class="material-icons my-3" style="font-size: 20;">exit_to_app</i><a href="/logout" style="color:#FFF" class="ml-3">Logout</a>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="addCampaignModal">
    <div class="modal-dialog" role="document">
        
    </div>
</div>
<style>
    .container {
        position: relative;
        width: 80%;
    }

    #image {
        display: block;
        width: 100%;
        height: 130px;
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

    .container:hover .overlay {
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
</style>
<!-- End Sidebar Menu ----------------------------------------------------------------------------------------------->
<script>
    $('#imgUpload').change(function() {
        $('#image-form').submit();
        displayAnimation();
    });

    $(document).ready(function(){
        $('#addCampaign').on('click', function(){
            var base_url = "<?php echo url('/campaign/new/create'); ?>";
            $.get( base_url, function( data ) {
                //alert(data);
                $('#addCampaignModal .modal-dialog').html(data);
            });
        });
    });
</script>
