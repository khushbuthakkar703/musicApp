@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="fa fa-circle text-success page-header-heading-icon"></span> Tyrone G <small>User Profile</small></h1>
                <p class="page-header-description">Tyrone is <strong>online now</strong>.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-xs-12 col-lg-9 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-clipboard"></span>&nbsp;&nbsp;User Details
                </div>
                <div class="panel-body">
                    <div class="profile-details">
                        <div class="profile-details-profile-picture">
                            <img src="{{ asset_segmented('img/user-1-profile.jpg') }}" alt="Tyrone Gary">
                        </div>
                        <div class="profile-details-info">
                            <h2 class="profile-details-info-name">Tyrone Gary <small>CEO at AdminCorp</small></h2>
                            <p class="profile-details-info-summary">Running the corporation, moving the money &amp; doing my best to contribute to society.</p>
                            <ul class="profile-details-info-contact-list">
                                <li class="profile-details-info-contact-list-item"><a href="mailto:tyrone.gary@example.com"><span class="fa fa-envelope profile-details-info-contact-list-item-icon"></span> tyrone.gary@example.com</a></li>
                                <li class="profile-details-info-contact-list-item"><span class="fa fa-phone profile-details-info-contact-list-item-icon"></span> +0 1234 56879</li>
                                <li class="profile-details-info-contact-list-item"><a href="#"> <span class="fa fa-twitter profile-details-info-contact-list-item-icon"></span>@tgexample</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-info-circle"></span>&nbsp;&nbsp;Personal Information
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Based In</th>
                            <td>United Kingdom</td>
                        </tr>
                        <tr>
                            <th>Works For</th>
                            <td>AdminCorp</td>
                        </tr>
                        <tr>
                            <th>Job Role</th>
                            <td>Chief Executive Officer</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-star"></span>&nbsp;&nbsp;Contributions
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Projects</th>
                            <td class="text-right"><strong>392</strong></td><td><small><span class="text-success">152 Complete</span> - <span class="text-warning">240 Ongoing</span></small></td>
                        </tr>
                        <tr>
                            <th>Articles</th>
                            <td class="text-right"><strong>56</strong></td><td><small><span class="text-success"><span class="fa fa-eye"></span> 1,573,283 Unique Views</span></small></td>
                        </tr>
                        <tr>
                            <th>Resources</th>
                            <td class="text-right"><strong>14</strong></td><td><small><span class="text-success"><span class="fa fa-download"></span> 291,489 Downloads</span></small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-download"></span>&nbsp;&nbsp;Resources
                </div>
                <div class="panel-body">
                    <p>Tyrone has provided some free resources for you to download. These are all licensed under the MIT License, unless stated otherwise in the document.</p>
                    <ul class="profile-resource-list">
                        <li class="profile-resource-list-item">
                            <span class="fa fa-file-o profile-resource-list-item-icon"></span>
                            Report on Lorem Ipsum
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right"><span class="fa fa-download"></span> Download</button>
                            <button class="btn btn-xs btn-transparent btn-transparent-info pull-right"><span class="fa fa-info-circle"></span> File Info</button>
                        </li>
                        <li class="profile-resource-list-item">
                            <span class="fa fa-file-o profile-resource-list-item-icon"></span>
                            User Guide to sit amet
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right"><span class="fa fa-download"></span> Download</button>
                            <button class="btn btn-xs btn-transparent btn-transparent-info pull-right"><span class="fa fa-info-circle"></span> File Info</button>
                        </li>
                        <li class="profile-resource-list-item">
                            <span class="fa fa-file-o profile-resource-list-item-icon"></span>
                            Report on Lorem Ipsum
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right"><span class="fa fa-download"></span> Download</button>
                            <button class="btn btn-xs btn-transparent btn-transparent-info pull-right"><span class="fa fa-info-circle"></span> File Info</button>
                        </li>
                        <li class="profile-resource-list-item">
                            <span class="fa fa-file-o profile-resource-list-item-icon"></span>
                            User Guide to sit amet
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right"><span class="fa fa-download"></span> Download</button>
                            <button class="btn btn-xs btn-transparent btn-transparent-info pull-right"><span class="fa fa-info-circle"></span> File Info</button>
                        </li>
                        <li class="profile-resource-list-item">
                            <span class="fa fa-file-o profile-resource-list-item-icon"></span>
                            Report on Lorem Ipsum
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right"><span class="fa fa-download"></span> Download</button>
                            <button class="btn btn-xs btn-transparent btn-transparent-info pull-right"><span class="fa fa-info-circle"></span> File Info</button>
                        </li>
                        <li class="profile-resource-list-item">
                            <span class="fa fa-file-o profile-resource-list-item-icon"></span>
                            User Guide to sit amet
                            <button class="btn btn-xs btn-transparent btn-transparent-primary pull-right"><span class="fa fa-download"></span> Download</button>
                            <button class="btn btn-xs btn-transparent btn-transparent-info pull-right"><span class="fa fa-info-circle"></span> File Info</button>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-lg-3 col-md-5">
            <a href="{{ route('admin.appPages.inbox.compose') }}" class="btn btn-info btn-block"><span class="fa fa-paper-plane"></span> Send message</a>
            <a href="{{ route('admin.appPages.inbox.compose') }}" class="btn btn-faded-blue btn-block"><span class="fa fa-users"></span> Add to contacts</a>
            <a href="{{ route('admin.appPages.inbox.compose') }}" class="btn btn-danger btn-faded btn-block"><span class="fa fa-ban"></span> Block communications</a>
            <div class="panel panel-default margin-top-15">
                <div class="panel-heading">
                    User Statistics
                </div>

                <ul class="list-group">
                    <li class="list-group-item"><span class="fa fa-comment"></span>&nbsp;&nbsp;<strong>215</strong> forum posts</li>
                    <li class="list-group-item"><span class="fa fa-thumbs-up"></span>&nbsp;&nbsp;<strong>5,123</strong> karma</li>
                    <li class="list-group-item"><span class="fa fa-clock-o"></span>&nbsp;&nbsp;<strong>4 years 2 months</strong> since they joined</li>
                    <li class="list-group-item"><span class="fa fa-eye"></span>&nbsp;&nbsp;<strong>152,923</strong> profile views</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection