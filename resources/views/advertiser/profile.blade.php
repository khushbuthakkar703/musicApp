@extends( Auth::user()->role === 'admin'  ?  'layouts.admin' : 'layouts.advertiser' )
@section('content')
<title>SpinStatz | {{$advertiser->name}}</title>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-lg-9 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-clipboard"></span>&nbsp;&nbsp;Employee Details
                </div>
                <div class="panel-body">
                    <div class="profile-details">
                        <div class="profile-details-profile-picture">
                            <img src="/{{$advertiser->user()->first()->profile_picture}}" alt="{{$advertiser->name}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-details-info">
                <h2 class="profile-details-info-name">{{$advertiser->name}}</h2>
                <p class="profile-details-info-summary">Paypal Email: {{$advertiser->paypal_email}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-lg-9 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Invited Campaign Details
                
                </div>
                <div class="panel-body">
                    <table class="table ">
                        <tr>
                            <th>id</th>
                            <th>Campaign Name</th>
                            <th>Contact Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Joined Date</th>    
                            <th>Money Earned</th>
                            <th> Deposited</th>
                        </tr>
                        @foreach($invitedCampaigns as $invitedCampaign)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$invitedCampaign->campaign_name}}</td>
                            <td>{{$invitedCampaign->first_name}}</td>
                            <td>{{$invitedCampaign->phone}}</td>
                            <td>{{$invitedCampaign->email}}</td>
                            <td>{{date("F jS, Y", strtotime($invitedCampaign->created_at))}}</td>
                            <td>{{$invitedCampaign->referral_amount_paid}}</td>
                            <td>@if($invitedCampaign->amount != null) ${{$invitedCampaign->amount}} @endif</td>
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
