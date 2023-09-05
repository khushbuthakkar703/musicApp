<header class="mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600 top-header">
    <!-- <div id="open" aria-expanded="false" role="button" tabindex="0" class="mt-3 mdl-layout__drawer-button"><i class="material-icons"></i></div> -->
    <div id="open" aria-expanded="false" role="button" tabindex="0" class="mt-4 mdl-layout__drawer-button display_none_btn"><i class="fas fa-bars" style="font-size:x-large;color: white;"></i></div>

    <div class="desktop-toggle-handler" style="display: none;"><i class="fas fa-bars" style="font-size:x-large;color: white;"></i></div>

    <div class="mdl-layout__header-row mdl-color--black mdl-color-text--grey-50">
        <!-- Welcome back message -->
        <div class="mdl-layout-spacer"></div>

        <label style="margin-left: -10px; font-weight:100">
            Welcome to Spinstatz
        </label>
        <div class="mdl-layout-spacer"></div>
        @if(Auth::check())
        <i class=" material-icons ml-2 my-2 head_inbox" style="font-size: 25;">local_post_office</i><a href="#" style="color:grey; margin-left:8px" class="mt-2"></a>

        <div class="btn-group d-flex">
            <!-- <span class="badge badge-default float-right item-feed-badge unseen-noification-count" style="background-color: rgb(132, 255, 255);"></span> -->
            <div style="cursor: pointer;" class="ml-2 getAllNotifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons mdl-badge mdl-badge--overlap" id="notificationsCount" data-badge="0">notifications</i> </div>

            <div id="noti" class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" style="color: rgb(132, 255, 255);">
                <img class="drawer-logo center-block" src="/images/SpinstatsApplogo.png" alt="Spinstats logo">
                <div class="dropdown-divider"></div>
                <a style="background-color: rgb(132, 255, 255);" href="/dj/request/payment" class="btn center-block" role="button">Withdraw Money</a>
                <div class="dropdown-divider"></div>
            </div>
        </div>

        <!-- <div>
            <a href="/logout" style="color: white;">Logout<i class="fas fa-sign-out-alt" style="font-size: 25px;"></i></a>
        </div> -->
        <!-- Sign Out -->
        <div class="head_log">
            <label>
                Log Out
            </label>
            <a href="/logout">
                <button class="mdl-button mdl-js-button mdl-button--icon mdl-color-text--grey-50">
                    <i class="material-icons">exit_to_app</i>
                </button>
            </a>
        </div>
        @else
            <span><a href="/"> Login</a></span>
        @endif
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
    }
</style>
