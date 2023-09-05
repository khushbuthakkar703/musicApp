<ul class="sidebar-nav">
    <li class="sidebar-nav-heading components"> Components</li>

    <li class="sidebar-nav-link keyer">
        <a href="{{route('regionadmin.index', ['region'=>\Auth::Id()])}}">
            <span class="typcn typcn-home sidebar-nav-link-logo "></span> Home
        </a>
    </li>
    <li class="sidebar-nav-link ">
        <a href="/genres">
            <span class="typcn typcn-user-add sidebar-nav-link-logo"></span> Manage Genres
        </a>
    </li>

    <li class="sidebar-nav-link ">
        <a href="{{route('regionadmin.payments', ['region'=>\Auth::Id()])}}">
            <span class="typcn typcn-user-add sidebar-nav-link-logo"></span> Payments
        </a>
    </li>
    <li class="sidebar-nav-link ">
        <a href="{{route('regionadmin.actions', ['region'=>\Auth::Id()])}}">
            <span class="typcn typcn-user-add sidebar-nav-link-logo"></span> Actions
        </a>
    </li>
    <li class="sidebar-nav-link ">
        <a href="{{route('inviteform')}}">
            <span class="typcn typcn-user-add sidebar-nav-link-logo"></span> Invitations
        </a>
    </li>
</ul>
