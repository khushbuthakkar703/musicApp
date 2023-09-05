@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-tags page-header-heading-icon"></span> Badges &amp; Labels</h1>
                <p class="page-header-description">Below is shown the different badges &amp; labels you can use with varello.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Labels
                </header>
                <div class="widget-body">
                    <p>The standard bootstrap labels, plus extra variants that come with Varello</p>
                    <p>
                        <span class="label label-default">Default</span>
                        <span class="label label-dark">Dark</span>
                        <span class="label label-primary">Primary</span>
                        <span class="label label-success">Success</span>
                        <span class="label label-info">Info</span>
                        <span class="label label-warning">Warning</span>
                        <span class="label label-danger">Danger</span>
                        <span class="label label-purple">Purple</span>
                        <span class="label label-pink">Pink</span>
                        <span class="label label-faded-blue">Faded Blue</span>
                    </p>

                    <p>Labels change size depending on the context they're used in</p>

                    <h1>Example heading <span class="label label-primary">New</span></h1> <h2 class="margin-top-15">Example heading <span class="label label-primary">New</span></h2> <h3 class="margin-top-15">Example heading <span class="label label-primary">New</span></h3> <h4 class="margin-top-15">Example heading <span class="label label-primary">New</span></h4> <h5 class="margin-top-15">Example heading <span class="label label-primary">New</span></h5> <h6 class="margin-top-15">Example heading <span class="label label-primary">New</span></h6>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Badges
                </header>
                <div class="widget-body">
                    <p>The standard bootstrap badges, plus extra variants that come with Varello</p>
                    <p>
                        <span class="badge badge-default">Default</span>
                        <span class="badge badge-dark">Dark</span>
                        <span class="badge badge-primary">Primary</span>
                        <span class="badge badge-success">Success</span>
                        <span class="badge badge-info">Info</span>
                        <span class="badge badge-warning">Warning</span>
                        <span class="badge badge-danger">Danger</span>
                        <span class="badge badge-purple">Purple</span>
                        <span class="badge badge-pink">Pink</span>
                        <span class="badge badge-faded-blue">Faded Blue</span>
                    </p>

                    <p>Unlike labels, badges maintain a consistent sizing, regardless of context.</p>

                    <h1>Example heading <span class="badge badge-primary">New</span></h1> <h2 class="margin-top-15">Example heading <span class="badge badge-primary">New</span></h2> <h3 class="margin-top-15">Example heading <span class="badge badge-primary">New</span></h3> <h4 class="margin-top-15">Example heading <span class="badge badge-primary">New</span></h4> <h5 class="margin-top-15">Example heading <span class="badge badge-primary">New</span></h5> <h6 class="margin-top-15">Example heading <span class="badge badge-primary">New</span></h6>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection