@extends('layouts.djmanager')
@section('content')
<link rel="stylesheet" type="text/css" href="/css/custom.css">

    <main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content profile_id ">
        <title>SpinStatz | {{$dj->dj_name}}</title>
        <div class="background-user" style="position: relative;">
            <div class="content">
                <div class="mdl-grid mb-3">
                    <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
                        <h3 id="user-dashboard ml-unset">Your Profile</h3>
                    </div>
                </div>
            </div> 
        </div>
           <br><br><br><br><br> <div class="container margin-over">
                    <div class="col-md-12 pl-0 sm-pr-0">
                        <div class="card-deck mt-4 col-12 spinstaz_dj">
                            <div class="card remove_margin col-md-8">
                                <div class="card-body m-3" style="color: rgb(132, 255, 255); text-align: left;">
                                    <div class="d-flex ml-5 mt-4 row">
                                        <div class="col-md-6 col-12 pl-0">
                                            <img src="/{{$dj->user()->first()->profile_picture}}" alt="" class="width-100 height-auto" width="270" height="270">
											
                                        </div>
                                        
                                        <div class="col-md-6 col-12 pl-0">
                                            <div>
                                                <p class="card-text mt-2" style="font-size: x-large; color:#FFF">{{$dj->dj_name}}</p>
                                                <table width="60%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <td><p class="card-text mt-2" style="font-size: 10pt; color:#FFF">Total Spins:</p></td>
                                                      <td align="left"><strong>{{$dj->total_spin}}</strong></td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                                <br><br><br><p class="mb-0"><b>Country:</b> {{ $country->name }}</p><br>
        <p class="mb-0"><b>State:</b> {{ $state->name }}</p><br>
        <p class="mb-0"><b>City:</b> {{ $city->name }}</p><br>
        <p class="mb-0"><b>Venue:</b>
            @if($dj->id <= 123)
                {{$dj->club_name}}
            @else
                {{$dj->clubs()->first()->name or 'Empty'}}
            @endif
        </p>
                                            </div>
                                            <ul class="advance_filter_ul pl-0">
                                                <li class="my-4">
                                                    {{$dj->description}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>    

<!--
                                    <div class="detils_tag">
                                        <p class="card-text mt-2" style="font-size: x-large; color:#FFF">Details</p>
                                    </div>
                                    <div class="input_fild">
                                        <div class="d-flex align-items-center row">
                                            <label for="" class="col-md-6">First Name</label>
                                            <div class="dropdown col-md-6 my-3">
                                               <input type="text" class="form-control" value="{{$dj->first_name}}" name="fname" data-validetta="required">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center row">
                                            <label for="" class="col-md-6">Last Name</label>
                                            <div class="dropdown col-md-6 my-3">
                                                <input type="text" class="form-control" value="{{$dj->last_name}}" name="lname" data-validetta="required">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center row">
                                            <label for="" class="col-md-6">Email Adress</label>
                                            <div class="dropdown col-md-6 my-3">
                                                <input type="email" class="form-control" value="{{$dj->user->email}}" name="email" data-validetta="required,email">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center row">
                                            <label for="" class="col-md-6">Phone Number</label>
                                            <div class="dropdown col-md-6 my-3">
                                               <input type="text" class="form-control" value="{{$dj->phone_number}}"name="phone" data-validetta="required">
                                            </div>
                                        </div>
                                        @if(Auth::user()->role === 'dj')
                                        <div class="d-flex align-items-center row">
                                           
                                        </div>
                                        @endif
                                    </div> -->
                                    <hr>
                                     <div class="detils_tag">
                                        <p class="card-text mt-2" style="font-size: x-large; color:#FFF">Social media</p>
                                    </div>
                                    <div>
										<ul class="profile-details-info-contact-list list_type_none">
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
                            <div class="col-md-4">
                                <div class="card mb-20 text-center sm-mt-20">
                                    <div class="card-body m-3" style="color: rgb(132, 255, 255); font-size: 11px;">
                                        <div class="info_box">
                                            <p class="card-text mt-2" style="font-size: x-large;">Information</p>
                                           
                                            <div id="qrcode" style="padding: 15px">

                                            </div>
                                        <span style="color: rgba(253,253,253,1)">Member Since:&nbsp;{{$dj->created_at->format('F j, Y')}}</span> </div>
                                    </div>
                                </div>
                                <div class="card mb-20">
                                    <div class="card-body m-3" style="color:rgb(132, 255, 255);">
                                        <div class="info_box">
                                            <p class="card-text mt-2" style="font-size: x-large;">Refferal Link</p>
                                            <div class="panel-heading referall_link" >
                                                <p><a href="{{ url('/campaign/create?refer=') }}{{($dj->id)}}">{{ url('/campaign/create?refer=') }}{{($dj->id)}}</a></p>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
            </div>  
            <div>
                <p></p>
            </div>     
    </main>

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
