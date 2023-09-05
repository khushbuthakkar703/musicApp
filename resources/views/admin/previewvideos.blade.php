@extends('layouts.admin')
@section('content')
<title>SpinStatz | Spin Videos</title>
<style>
    .mask {
        background: red;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<div class="container-fluid" id="amount">
    <div class="row">
        <div class="widget widget-default widget-fluctuation fc-state-active">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="profile-details col-lg-4">
                        <div class="profile-details-profile-picture">
                            <img src="/{{$dj->user()->first()->profile_picture}}" >
                        </div>
                        <div class="profile-details-info">
                            <h2 class="profile-details-info-name">{{$dj->dj_name}} </h2>
                            <p class="profile-details-info-summary">{{$dj->description}}</p>
                            <ul class="profile-details-info-contact-list">
                                <li class="profile-details-info-contact-list-item">
                                    <a href="mailto:{{$dj->user()->first()->email}}">
                                        <span class="fa fa-envelope profile-details-info-contact-list-item-icon"></span>{{$dj->user()->first()->email}}
                                    </a>
                                </li>
                                <li class="profile-details-info-contact-list-item"><span
                                            class="fa fa-phone profile-details-info-contact-list-item-icon"></span>
                                    {{$dj->phone_number}}
                                </li>
                                <li class="profile-details-info-contact-list-item"><a
                                            href="#">
                                        <span class="fa fa-twitter profile-details-info-contact-list-item-icon"></span>{{$dj->twitter}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-4">
                        <h2>Request Amount: $[[request_amount]]</h2>
                        <h2>Payable Amount: $[[payable_amount]]</h2>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            PAY
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($paid_videos as $spin)
        <div class="col-md-6 col-lg-4">
            <div class="widget widget-default widget-fluctuation video-card">
                <header class="widget-header">
                    <span class="pull-left">{{$spin->MusicCampaignAudio->getTitle()}}</span>
                    <span class="pull-right" id="ep-{{$spin->id}}">{{$spin->payments_records['dj_earned_points'] or null}}</span>
                </header>

                <div class="widget-body">


                    <video width="300" height="160" controls>
                        <source src="http://spinstatz.org/records/{{$spin->videos}}" type="video/ogv" />
                        <source src="http://spinstatz.org/records/{{$spin->videos}}" type="video/mp4" />
                        <source src="http://spinstatz.org/records/{{$spin->videos}}" type="video/webm" />
                        Your browser does not support the video tag.
                    </video>

                </div>
                <header class="widget-header">
                    <span class="widget-statistic-description">Recorded Time: {{date("M/d/Y h:i a", strtotime($spin->created_at)) }}</span>
                    @if($spin->payments_records['status'] == \App\IdentifiedMusic::denied || $spin->payments_records['status'] == \App\IdentifiedMusic::withdraw_requested )
                        <span class="label label-danger pull-right reject btn danger" id="r-{{$spin->id}}">Accept</span>
                    @else
                        <span class="label label-info pull-right reject btn danger" id="r-{{$spin->id}}">Reject</span>
                    @endif
                </header>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        {{ $paid_videos->links() }}
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <form method="post" action="{{ route('payout') }}">
                        {{ csrf_field() }}
                        Are you want to sure to pay $[[payable_amount]]?
                        <input type="hidden" name="id" value={{$withdraw_request->id}}>
                        <input type="submit" value="Pay Now" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function update(status, opts){
            fetch('/admin/payment_request_action/'+status, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(opts)
            })
                .then(response => response.json())
                .then(data => console.log(data));

        }

        var app = new Vue({
            delimiters: ["[[","]]"],
            el: '#amount',
            data: {
                'request_amount': {{$withdraw_request->request_amount}},
                'payable_amount': {{$withdraw_request->payable_amount}}
            }

        })

        $('.reject').click(function() {
            // debugger
            id = this.id.split("-")[1]
            ep = $("#ep-"+id).text()
            if(ep === ""){
                ep = 0
            }else {
                ep = parseFloat(ep)
            }
            opts = {"ids": id}
            if(this.classList.contains("label-info")){
                this.classList.remove("label-info")
                update(3, opts)
                this.classList.add("label-danger")
                this.innerText = "Accept"
                app.payable_amount -= ep

            }else{
                this.classList.remove("label-danger")
                update(2, opts)
                this.classList.add("label-info")
                this.innerText = "Reject"
                app.payable_amount += ep
            }

        });
    </script>
</div>
@endsection
