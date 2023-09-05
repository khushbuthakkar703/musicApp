@extends('layouts.app')
@section('content')
    <script src="/js/easyqrcodejs/src/easy.qrcode.js"></script>
    <title>SpinStatz | {{$dj->dj_name}}</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-lg-9 col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-clipboard"></span>&nbsp;&nbsp;DJ Details
                    </div>
                    <div class="panel-body">
                        <div class="profile-details">
                            <div class="profile-details-profile-picture">
                                <img src="/{{$dj->user()->first()->profile_picture}}" alt="{{$dj->first_name."\n".$dj->last_name}}">
                            </div>
                            <div class="profile-details-info">
                                <h2 class="profile-details-info-name">{{$dj->dj_name}}
                                    <small></small>
                                </h2>
                                <p class="profile-details-info-summary">{{$dj->description}}</p>

                                <ul class="profile-details-info-contact-list">
                                    <li class="profile-details-info-contact-list-item">
                                        @if($dj->twitter != null)
                                        <a href="https://twitter.com/{{$dj->twitter}}"  target="_blank"> <img src="/img/tw.png" alt=""/>
                                        </a>&nbsp;&nbsp;
                                        @endif
                                        @if($dj->facebook != null)
                                        <a href="https://facebook.com/{{$dj->facebook}}"  target="_blank"> <img src="/img/fb.png" alt=""/>
                                        </a>&nbsp;&nbsp;
                                        @endif
                                        @if($dj->instagram != null)
                                        <a href="https://instagram.com/{{$dj->instagram}}"  target="_blank"><img src="/img/ig.png" alt=""/>
                                        </a>&nbsp;&nbsp;
                                        @endif
                                        @if($dj->soundcloud != null)
                                        <a href="#"  target="_blank"> <img src="/img/sc.png" alt=""/>
                                        </a>&nbsp;&nbsp;
                                        @endif
                                        @if($dj->youtube != null)
                                        <a href="#"  target="_blank"> <img src="/img/yt.png" alt=""/>
                                        </a>&nbsp;&nbsp;
                                        @endif
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="panel panel-default">

                    <div class="panel-heading">

                        <span class="fa fa-star"></span>&nbsp;&nbsp;Campaign Participation

                    </div>

                    <table class="table">

                        <tbody>

                        <tr>

                            <th>Music Campaigns</th>

                            <td class="text-right"><span class="text-warning">{{$accCampaignCount}} Active</span></td>
                            <td>
                               <span class="text-success">{{$completedCampaignCount}} Completed</span>
                                
                            </td>

                        </tr>

                        <tr>

                            <th>Reported Spins</th>

                            <td class="text-right"><strong>{{$dj->total_spin}}</strong></td>
                            <!-- <td>
                                <small><span class="text-success"><span
                                                class="fa fa-line-chart"></span> {{$dj->total_spin}} Spins</span></small>
                            </td> -->

                        </tr>

                        <tr>

                            <th>Joined</th>

                            <td class="text-right">{{$dj->created_at}}</td>
                            <!-- <td>
                                <small><span class="text-success"><i class="fa fa-handshake-o" aria-hidden="true"></i> {{$dj->created_at}}</span>
                                </small>
                            </td> -->

                        </tr>

                        </tbody>

                    </table>

                </div>

                <div class="panel panel-default">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            QR Code
                        </div>
                        <div id="qrcode" style="padding: 15px">
                            
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xs-12 col-lg-3 col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        DJ Information
                    </div>


                    <ul class="list-group">
                        <li class="list-group-item"><span
                                    class="fa fa-globe"></span>&nbsp;&nbsp;<strong>Country: </strong>{{$country->name}}
                        </li>
                        <li class="list-group-item"><span
                                    class="fa fa-map-marker"></span>&nbsp;&nbsp;<strong>City:</strong> {{$city->name}}</li>
                        <li class="list-group-item"><span
                                    class="fa fa-map-o"></span>&nbsp;&nbsp;<strong>State:</strong> {{$state->name}}</li>
                        <li class="list-group-item"><span class="fa fa-dot-circle-o"></span>&nbsp;&nbsp;<strong>DJ
                                Software:</strong> {{$dj->software or 'Empty'}}
                        </li>
                        <li class="list-group-item"><span class="fa fa-money"></span>&nbsp;&nbsp;<strong>Works
                                For</strong> {{$mName}}
                        </li>
                        <li class="list-group-item"><span class="fa fa-music"></span>&nbsp;&nbsp;<strong>Job
                                Position:</strong> Disc Jockey
                        </li>
                        <li class="list-group-item"><span
                                    class="fa fa-users"></span>&nbsp;&nbsp;<strong>Club:</strong>
                                @if($dj->id <= 123)
                                    {{$dj->club_name}}
                                @else
                                    {{$dj->clubs()->first()->name or 'Empty'}}
                                @endif
                        </li>
                    </ul>


                </div>

            </div>

        </div>
    </div>
    <script type="text/javascript">
        

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: window.location.href,
            logo: "/img/qr.jpg",
            logoWidth: undefined,
            logoHeight: undefined,
            logoBackgroundColor: '#ffffff',            
            logoBackgroundTransparent: false
    });
    </script>

@endsection