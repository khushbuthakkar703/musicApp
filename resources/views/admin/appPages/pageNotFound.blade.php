@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="jumbotron">
                <h1>404 Page Not Found</h1>
                <p>Sorry, the page you were looking for could not be found! You may have enterred an incorrect URL, or the page might have been removed.</p>
                <p><a class="btn btn-primary btn-lg" href="{{ route('admin.dashboard') }}" role="button">Go to your dashboard</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection