@extends('layout.adminInbox')

@section('rightContent')
<div class="panel">
    <div class="panel-body">
        <div>
            <form class="form-inline pull-right">
                <div class="form-group">
                    <input type="text" placeholder="Search Inbox..." class="form-control inbox-search-input"><button class="btn btn-transparent btn-transparent-white">Search</button>
                </div>
            </form>
            <h1 class="inbox-main-heading">Inbox <small>(22 unread)</small></h1>
        </div>
        <div class="inbox-actions">
            <button class="btn btn-transparent btn-transparent-white btn-sm"><span class="fa fa-refresh"></span> Refresh</button>
            <button class="btn btn-transparent btn-transparent-info btn-sm"><span class="fa fa-eye"></span> Mark As Read</button>
            <button class="btn btn-transparent btn-transparent-warning btn-sm"><span class="fa fa-exclamation-circle"></span> Flag As Important</button>
            <button class="btn btn-transparent btn-transparent-danger btn-sm"><span class="fa fa-trash"></span> Move To Trash</button>
            <div class="btn-group pull-right">
                <button class="btn btn-transparent btn-transparent-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                <button class="btn btn-transparent btn-transparent-white btn-sm"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <table class="table table-inbox table-vertical-align-middle">
        <thead>
            <tr>
                <th></th>
                <th>From</th>
                <th>Message</th>
                <th></th>
                <th></th>
                <th>Sent</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-inbox-row-unread">
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">John Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td><span class="fa fa-circle text-success"></span> <span class="fa fa-circle text-warning"></span></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">3 hours ago</small></td>
            </tr>
            <tr class="table-inbox-row-unread">
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jim Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">6 days ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jack Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td><span class="fa fa-circle text-primary"></span></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">7 weeks ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jill Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">9 months ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">John Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td><span class="fa fa-circle text-info"></span></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">3 hours ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jim Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">6 days ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jack Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">7 weeks ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jill Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">9 months ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jack Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">7 weeks ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jill Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td><span class="fa fa-circle text-info"></span> <span class="fa fa-circle text-success"></span> <span class="fa fa-circle text-warning"></span> <span class="fa fa-circle text-primary"></span></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">9 months ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">John Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">3 hours ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jim Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">6 days ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jack Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">7 weeks ago</small></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" class="table-row-checkbox">
                </td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Jill Doe</a></td>
                <td><a href="{{ route('admin.appPages.inbox.view') }}">Hey man, have you seen the new...</a></td>
                <td></td>
                <td><span class="fa fa-paperclip"></span></td>
                <td><small class="text-muted">9 months ago</small></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('sidebarContent')
@include('layout.adminInbox.sidebar')
@endsection