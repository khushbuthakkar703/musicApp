@php($djdata = App\Dj::where('user_id',$currentUser->id)->first())
<ul class="sidebar-nav">

<li class="sidebar-nav-link dashboard">
    <a href="/dj/dashboard">
        <span class="typcn typcn-home sidebar-nav-link-logo "></span> Dashboard
    </a>
</li>
<li class="sidebar-nav-link sidebar-nav-link-group profile">
    <a href="/dj/profile/{{$djdata->id}}" data-subnav-toggle="">
        <span class="typcn typcn-document sidebar-nav-link-logo profile"></span> Profile
    </a>
</li>

<li class="sidebar-nav-link inbox1">
    <a href="/dj/inbox">
        <span class="typcn typcn-folder-open sidebar-nav-link-logo"></span> Inbox
        <span class="badge badge-info sidebar-nav-link-badge"></span>
    </a>
</li>

<li class="sidebar-nav-link history">
    <a href="/dj/history">
                    <span class="typcn typcn-chart-line sidebar-nav-link-logo">
                    </span> History
    </a>
</li>

<li class="sidebar-nav-link download"><a href="/dj/app/download"> <span
                class="typcn typcn-download sidebar-nav-link-logo"></span> Reporting Software </a></li>
<li class="sidebar-nav-link edit">
    <a href="/dj/profile/edit">
        <span class="typcn typcn-user-add sidebar-nav-link-logo"></span> Update Profile
    </a>
</li>
<li class="sidebar-nav-link invite"><a href="/invitecampaign"> <span
                class="typcn typcn-group-outline sidebar-nav-link-logo"></span> Referral Link </a></li>
<li class="sidebar-nav-link "> <a href="/dj-notification"> <span class="fa fa-bell sidebar-nav-link-logo"></span> Notifications </a> </li>
<li class="sidebar-nav-link accepted"><a href="/dj/accepted/campaign"> <span
                class="typcn typcn-chart-line sidebar-nav-link-logo"></span> Accepted Campaigns </a></li>
    <li class="sidebar-nav-link accepted"><a href="/dj/accepted/campaign"> <span
                    class="typcn typcn-chart-line sidebar-nav-link-logo"></span> Accepted Campaigns </a></li>
</ul>
