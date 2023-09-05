@php
    $currentUser = auth()->user();
    $role = auth()->user()->role;
    $role=ucwords($role);
@endphp

<!-- Begin Top Notification Bar ---------------------------------------------------------------------------------------->
<header class="mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600 top-header">
    <!-- <div id="open" aria-expanded="false" role="button" tabindex="0" class="mt-3 mdl-layout__drawer-button"><i class="material-icons"></i></div> -->
    <div id="open" aria-expanded="false" role="button" tabindex="0" class="mt-4 mdl-layout__drawer-button display_none_btn"><i class="fas fa-bars" style="font-size:x-large;color: white;"></i></div>

    <div class="desktop-toggle-handler" style="display: none;"><i class="fas fa-bars" style="font-size:x-large;color: white;"></i></div>

    <div class="mdl-layout__header-row mdl-color--black mdl-color-text--grey-50">
        <!-- Welcome back message -->
        <div class="mdl-layout-spacer"></div>
        @if(request()->segment(2)=='dashboard')
        @if(!empty($campaignLists))
        <select class="form-control campaign-select select-matirial-design" id="sel1">
            @foreach($campaignLists as $campaignList)
                <option value="{{$campaignList->id}}" @if($musicCampaign->id == $campaignList->id) selected @endif>{{$campaignList->campaign_name}}</option>
            @endforeach
        </select>
        @endif
        @endif

        <!-- <label style="margin-left: -10px; font-weight:100">
            Welcome to Spinstatz, <?php echo auth()->user()->username." "; ?><?php echo "(".$role.")"; ?>
        </label> -->
        <div class="mdl-layout-spacer"></div>

        <i class=" material-icons ml-2 my-2 head_inbox" style="font-size: 25;">local_post_office</i><a href="#" style="color:grey; margin-left:8px" class="mt-2"></a>

        <div class="btn-group d-flex">
            <!-- <span class="badge badge-default float-right item-feed-badge unseen-noification-count" style="background-color: rgb(132, 255, 255);"></span> -->
            <div style="cursor: pointer;" class="ml-2 getAllNotifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons mdl-badge mdl-badge--overlap" data-badge="0">notifications</i> </div>

            <div id="noti" class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" style="color: rgb(132, 255, 255);border-radius: 5px;">
                <!-- <img class="drawer-logo center-block" src="/images/SpinstatsApplogo.png" alt="Spinstats logo"> -->
                <span class="drawer-logo center-block notification-text">Notifications</span>
            </div>
        </div>

        <!-- <div>
            <a href="/logout" style="color: white;">Logout<i class="fas fa-sign-out-alt" style="font-size: 25px;"></i></a>
        </div> -->
        <!-- Sign Out -->
        <div class="head_log">
            <!-- <label>
                Log Out
            </label> -->
            <a href="/logout">
                <button class="mdl-button mdl-js-button mdl-button--icon mdl-color-text--grey-50">
                    <i class="material-icons">exit_to_app</i>
                </button>
            </a>
        </div>
    </div>
</header>
<script src="/js/notification.js"></script>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '1476167555843900',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v2.12'
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@yield('custom_js')
<div class="fb-customerchat" page_id="582913385432510">
</div>

<style>
    /* .dropdown-menu-notifications-item-content span {
        display: inline-block;
        vertical-align: middle;
        padding: 0;
    }

    .dropdown-menu-notifications-item-content p {
        margin: 0;
        padding-left: 10px;
    }

    .dropdown-menu-notifications-item-content span p:first-child {
        font-weight: bold;
        color: rgb(132, 255, 255);
        margin-bottom: 10px;
    }

    .dropdown-menu.dropdown-menu-notifications {
        padding: 0 !important;
    }

    .dropdown-menu-notifications a {
        padding: 7px 15px !important;
    }

    .dropdown-menu.dropdown-menu-notifications li {
        background: #2f3638;
    }

    .dropdown-menu.dropdown-menu-notifications li:nth-child(2n) {
        background: #424445;
    } */

    .notification-text {
        font-weight: bold;
        font-size: 20px;
        color: #000;
        padding: 2px 18px !important;
        margin-left: 0;
        margin-right: 0;
    }
    .dropdown-menu-notifications-item-content span {
        display: inline-block;
        vertical-align: middle;
        padding: 0;
    }

    .dropdown-menu-notifications-item-content p {
        margin: 0;
        padding-left: 10px;
    }

    .dropdown-menu-notifications-item-content span p:first-child {
        /* font-weight: bold; */
        color: #000;
        margin-bottom: 7px;
        /* font-size: 13px; */
        white-space: normal;
        line-height: 120%;
    }

    .dropdown-menu.dropdown-menu-notifications {
        padding: 0 !important;
    }

    .dropdown-menu-notifications a {
        padding: 10px 15px !important;
    }

    #noti {
        background-color: rgb(224, 224, 224) !important;
    }

    .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-menu > li > a:active {
        background-color: rgb(224, 224, 224) !important;
    }

    .dropdown-menu-notifications .dropdown-menu-notifications-item {
        border-bottom: 0px;
    }

    .campaign-select {
        color: #333333;
        background-color: #FFFFFF !important;
        border: 1px solid #FFFFFF !important;
        border-radius: 20px;
        padding: 5px 12px;
        width: 300px;
        height: 44px;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right .75rem center;
        background-size: 20px 15px;
        position: absolute;
        left: 5%;
    }
</style>
