@extends('layouts.advertiser')
@section('content')
 <title>SpinStatz | Dashboard</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="margin-top-0">Advertiser Dashboard</h4>
          		<span class="margin-top-0">
            	<h4 class="margin-top-0"></h4>
            		Music Campaigns <small>View campaigns and select which to support.</small></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="widget widget-statistic widget-default"> 
                    <header class="widget-statistic-header">money earned</header>
                    <div class="widget-statistic-body"><span class="widget-statistic-value"><i
                                    class="fa fa-usd"></i><span
                                    id="dj-earn-balance">{{$advertiser->points_earned}}</span></span>
                        <section class="widget-fluctuation-period">
                            <a href="/advertiser/request/payment">
                                <button class="btn btn-sm btn-transparent-white" type="button"><span class="fa fa-usd">&nbsp;</span>Withdraw
                                    Money
                                </button>
                            </a>
                        </section>
                        <span class="widget-statistic-icon fa fa-credit-card-alt"></span></div>
                </div>
            </div>
            <!-- <div class="col-md-6 col-lg-4">
                <div class="widget widget-purple widget-fluctuation">
                    <header class="widget-header">Invite Code</header>
                    <div class="widget-body">

                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-6 col-lg-4">
                <div class="widget widget-purple widget-fluctuation">
                    <header class="widget-header"> MONTHLY PERFORMANCE</header>
                    <div class="widget-body">
                        <section class="widget-fluctuation-period"><span class="widget-fluctuation-period-text"><strong>12
                                    spins</strong> in <strong>1</strong></span><br>
                            
                        </section>
                        <section class="widget-fluctuation-description"><span
                                    class="widget-fluctuation-description-amount">5</span>spins increase <span
                                    class="widget-fluctuation-description-text">from last month</span></section>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
        	<div class="widget widget-default widget-fluctuation">
        		<header class="widget-header">Campaign's List</header>
                    <table class="table">
                        <tr>
                            <th>SN</th>
                            <th>Campaign Name</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Phone No</th>
                            <th>Earned</th>
                            <th>Deposited</th>
                        </tr>
            		@foreach($datas as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data['invitee']['campaign_name']}}</td>
                        <td>{{$data['invitee']['first_name'] . " " . $data['invitee']['last_name']}}</td>
                        <td>{{$data['invitee']['email']}}</td>
                        <td>{{$data['invitee']['name']}}</td>
                        <td>{{$data['invitee']['phone']}}</td>

                        <td>${{$data['invitee']['referral_amount_paid']}}</td>
                        <td>
                            @foreach($data['transactions'] as $transaction)
                                <li>{{$transaction['amount']}}</li>
                            @endforeach
                        </td>
                    </tr>
            		@endforeach
                </table>
            	<div class="widget-body">
        		</div>
        </div>
        <!-- <div class="row">
        	<div class="widget widget-default widget-fluctuation">
        		<header class="widget-header">Advertiser's List</header>
            	<div class="widget-body">
        		</div>
        	</div>
        </div>
        <div class="row">
        	<div class="widget widget-default widget-fluctuation">
        		<header class="widget-header">Advertiser's List</header>
            	<div class="widget-body">
        		</div>
        	</div>
        </div> -->
    </div>
@endsection
