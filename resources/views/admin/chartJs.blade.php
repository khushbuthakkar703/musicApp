@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-chart-line page-header-heading-icon"></span> Chart.js</h1>
                <p class="page-header-description">The wonderful Chart.js library provides you with great statistical chart views. You can view the full Chart.js documentation <a href="http://www.chartjs.org/docs" target="_blank">here</a>.
                </p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Line Chart
                </header>
                <div class="widget-body">
                    <canvas id="chart-example-line"></canvas>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Bar Chart
                </header>
                <div class="widget-body">
                    <canvas id="chart-example-bar"></canvas>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Polar Area Chart
                </header>
                <div class="widget-body">
                    <canvas id="chart-example-polar"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Radar Chart
                </header>
                <div class="widget-body">
                    <canvas id="chart-example-radar"></canvas>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Pie Chart
                </header>
                <div class="widget-body">
                    <canvas id="chart-example-pie"></canvas>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Doughnut Chart
                </header>
                <div class="widget-body">
                    <canvas id="chart-example-doughnut"></canvas>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection

@section('scripts')
<script src="js/pages/chart-js.js"></script>
@endsection