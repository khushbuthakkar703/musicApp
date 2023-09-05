@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-chart-bar page-header-heading-icon"></span> Progress Bars</h1>
                <p class="page-header-description">Another useful way to frame fractional statistics.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <!-- START CONTAINER -->
    <div class="row">
        <!-- START CONTENT ROW -->
        <div class="col-xs-12">
            <div class="widget widget-default">
                <header class="widget-header">
                    Standard Progress Bars
                </header>
                <div class="widget-body">
                    <div class="progress">
                      <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100" style="width: 97%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-light" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-pink" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-faded-blue" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                      </div>
                    </div>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Standard Progress Bars
                </header>
                <div class="widget-body">
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-default" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100" style="width: 97%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-light" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-purple" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-pink" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-faded-blue" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                      </div>
                    </div>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    With Label
                </header>
                <div class="widget-body">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                        80%
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                        45%
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-pink" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                        20%
                      </div>
                    </div>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Animated
                </header>
                <div class="widget-body">
                    <p>Add <code>.active</code> to <code>.progress-bar-striped</code> to animate stripes right to left. Not available in &lt;=IE9.</p>

                    <div class="progress">
                      <div class="progress-bar progress-bar-striped active progress-bar-primary" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      </div>
                    </div>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Stacked
                </header>
                <div class="widget-body">
                    <p>Place multiple bars in the same <code>.progress</code> to stack them.</p>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" style="width: 35%">
                        90%
                        <span class="sr-only">35% Complete (success)</span>
                      </div>
                      <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%">
                        <span class="sr-only">20% Complete (warning)</span>
                      </div>
                      <div class="progress-bar progress-bar-danger" style="width: 10%">
                        <span class="sr-only">10% Complete (danger)</span>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT ROW -->
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection