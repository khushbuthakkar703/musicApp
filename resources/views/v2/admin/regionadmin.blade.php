@extends('layouts.admin')
@section('content')
    <div class="content-dimmer"></div>
    <header class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-lg-9">
                    <h1 class="page-header-heading"><span class="typcn typcn-th-small page-header-heading-icon"></span> RegionAdmins</h1>

                </div>
                <div class="col-xs-12 col-lg-3">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Admins</button>

                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="widget widget-default">
                <div class="widget-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th>User Name</th>
                            <th>Email</th>
                            <th>PhoneNo</th>
                            <th>Countries</th>
                            <th class="text-right" colspan="2" style="text-align: center;">Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($regionAdmins as $regionAdmin)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$regionAdmin->user->username}}</td>
                                <td>{{$regionAdmin->user->email}}</td>
                                <td>${{$regionAdmin->phone}}</td>
                                <td>${{$regionAdmin->countries()->pluck('name')}}</td>

                                <td class="text-right">
{{--                                    <form method="POST" action="{{route('admin.artistmanager')}}">--}}
{{--                                        <div class="btn-group">--}}

{{--                                            <input type="hidden" name="campaign" value="{{$campaign->id}}">--}}
{{--                                            <select class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="row-{{$campaign->id}}" name="artistmanager">--}}
{{--                                                <option value="0">None</option>--}}
{{--                                                @foreach($artistmanagers as $am)--}}
{{--                                                    <option value="{{$am->id}}" @if(in_array($campaign->id,json_decode($am->campaign_ids, true))) selected="true"  @endif > {{$am->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}

{{--                                        </div>--}}
{{--                                        <input type="Submit" value="Update" class="btn active btn-danger">--}}
{{--                                    </form>--}}
                                <td>

                                </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
{{--            {{$campaigns->links()}}--}}
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add new regionadmin</h4>
                    </div>
                    <form method="POST" action="{{route('admin.regionadmin.add')}}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required="true">
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required="true">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" name="email" required="true">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required="true">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone No:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required="true">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" value="Submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
