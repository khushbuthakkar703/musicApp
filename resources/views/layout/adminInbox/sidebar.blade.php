<div class="panel">
    <div class="panel-body">
        <ul class="inbox-sidebar-list">
            <li class="inbox-sidebar-compose">
                <a href="{{ route('admin.appPages.inbox.compose') }}" class="btn btn-block btn-lg btn-primary">Compose New</a>
            </li>
        </ul>
        <ul class="inbox-sidebar-list">
            <li class="inbox-sidebar-heading">
                <h2 class="inbox-sidebar-heading-title">Folders</h2>
            </li>
            <li class="inbox-sidebar-item @if(empty(request()->segment(2))) active @endif">
                <a href="{{ route('admin.appPages.inbox') }}"><span class="fa inbox-sidebar-icon fa-inbox"></span> Inbox</a>
            </li>
            <li class="inbox-sidebar-item">
                <a href="#"><span class="fa inbox-sidebar-icon fa-pencil"></span> Drafts</a>
            </li>
            <li class="inbox-sidebar-item">
                <a href="#"><span class="fa inbox-sidebar-icon fa-paper-plane-o"></span> Sent</a>
            </li>
            <li class="inbox-sidebar-item">
                <a href="#"><span class="fa inbox-sidebar-icon fa-recycle"></span> Junk</a>
            </li>
            <li class="inbox-sidebar-item">
                <a href="#"><span class="fa inbox-sidebar-icon fa-trash"></span> Trash</a>
            </li>
        </ul>
        <ul class="inbox-sidebar-list">
            <li class="inbox-sidebar-heading">
                <h2 class="inbox-sidebar-heading-title">Tags</h2>
            </li>
            <li class="inbox-sidebar-tag">
                <a href="#"><span class="fa inbox-sidebar-icon fa-circle text-primary"></span> General</a>
            </li>
            <li class="inbox-sidebar-tag">
                <a href="#"><span class="fa inbox-sidebar-icon fa-circle text-success"></span> Information</a>
            </li>
            <li class="inbox-sidebar-tag">
                <a href="#"><span class="fa inbox-sidebar-icon fa-circle text-info"></span> Personal</a>
            </li>
            <li class="inbox-sidebar-tag">
                <a href="#"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span> Important</a>
            </li>
        </ul>
        <ul class="inbox-sidebar-list">
            <li class="inbox-sidebar-heading">
                <h2 class="inbox-sidebar-heading-title">Labels</h2>
            </li>
            <li class="inbox-sidebar-labels">
            <a href="#" class="label label-primary"><span class="fa fa-tag"></span> Home</a>
            <a href="#" class="label label-primary"><span class="fa fa-tag"></span> Passwords</a>
            <a href="#" class="label label-primary"><span class="fa fa-tag"></span> Confidential</a>
            <a href="#" class="label label-primary"><span class="fa fa-tag"></span> Holidays</a>
            <a href="#" class="label label-primary"><span class="fa fa-tag"></span> Tax Returns</a>
            <a href="#" class="label label-primary"><span class="fa fa-tag"></span> Read Later</a>
            </li>
        </ul>
    </div>
</div>