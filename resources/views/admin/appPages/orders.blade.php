@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="fa fa-cart-plus page-header-heading-icon"></span> Orders</h1>
                <p class="page-header-description">Manage your orders here.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">

    <div class="row">

        <div class="col-md-6 col-xs-12">
            <table class="table" id="order-table">
                <thead>
                    <tr>
                        <th>Test</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>One</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.partials.footer')
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/pages/orders.js"></script>
@endsection