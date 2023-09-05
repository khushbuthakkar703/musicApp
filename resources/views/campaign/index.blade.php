@extends('layouts.campaignapp')
<link rel="stylesheet" type="text/css" href="/css/custom.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content">

  @if($flash=session('message'))
  <div class="alert alert-success" role="alert">
    {{$flash}}
  </div>
  @endif
  @if($flash=session('error'))
  <div class="alert alert-danger" role="alert">
    {{$flash}}
  </div>
  @endif

  <div class="content pt-0">
    <div class="row card-deck col-12 campaign_filter pr-2">
      <div class="campaign-details-section col-xs-12 col-sm-6 pl-0">
        <div class="card">
          <div class="card-body" style="color:rgb(132, 255, 255);">
            <div class="d-flex ml-1 mt-1">
                @if($musicCampaignAudio!=null)
                <img src="/{{$musicCampaignAudio->artwork}}" class="campaign-img" alt="{{$musicCampaign->campaign_name}}">
                @endif
              <div class="col-sm-6 col-xs-6">
              <ul class="advance_filter_ul pl-0" style="font-size:17px;margin-bottom:0">
                  <li class="my-2">
                    Song Name:
                    @if($musicCampaignAudio->song_title=='')
                      <span class="music-data"> </span>
                    @else
                      <span>{{$musicCampaignAudio->song_title}}</span>
                    @endif
                  </li>
                  <li class="my-2">
                    Artist:
                    @if($musicCampaignAudio->artist_name=='')
                      <span class="music-data"></span>
                    @else
                      <span>{{$musicCampaignAudio->artist_name}}</span>
                    @endif
                  </li>
                  <li class="my-2">
                    Genre:
                    @if($musicCampaignAudio->genre=='')
                      <span class="music-data"></span>
                    @else
                      <span>{{$musicCampaignAudio->genre}}</span>
                    @endif
                  </li>
                  <li class="my-2">
                    Label:
                    @if($musicCampaignAudio->company_name=='')
                      <span class="music-data"></span>
                    @else
                      <span>{{$musicCampaignAudio->company_name}}</span>
                    @endif
                  </li>
                  <li class="my-2">
                    BPM:
                    @if($musicCampaign->bpm=='')
                      <span class="music-data"></span>
                    @else
                      <span>{{$musicCampaign->bpm}}</span>
                    @endif
                  </li>
                  <li class="my-2">
                    Likes:
                    @if($musicCampaign->likes=='' && $musicCampaign->dislikes == '')
                      <span class="music-data"></span>
                    @else
                      <span>
                        <td><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$musicCampaign->likes}}</td>
                        <td><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{$musicCampaign->dislikes}} </td>
                      </span>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-deck col-xs-12 col-sm-6 advance_filter pt-4 pr-0">
        <div class="card mr-0" style="color: white; background-color: black;">
          <div class="card-body ml-3 mr-3 mt-4 mb-0" style="color:rgb(132, 255, 255);">
            <div>
              <p style="font-size: 15px; color:#FFF">Social Media</p>
            </div>
            <form class="form-inline youtube_form" id="youtubeForm" method="post" action="#">
              <div class="height-50 w-100 mt-2 row" >
                <div class="col-sm-3 col-xs-3" style="color:white;">
                  <i class="fa fa-youtube-play mr-3" aria-hidden="true" style="color: rgb(224, 224, 224);font-size: 27px;position: relative;"></i>
                  <span style="margin-top: 4px;position: absolute;" class="social-text">Youtube</span>
                </div>
                
                @if($musicCampaignAudio->youtube_feature==NULL)
                  <div class="col-sm-6 col-xs-6 " id="addYoutube">
                      <input class="form-control text-social" type="text" name="youtube" id="youtube" value="{{$musicCampaignAudio->youtube_feature}}" placeholder="Enter link" style="height: 27px;"><br>
                      <label id="youtube-error" class="error" for="youtube" style="color: red;display: inline-block;"></label>
                  </div>
                  <div class="col-sm-3 col-xs-3" id="youtubeBtn">
                    <button type="submit" value="button" class="btn social-btn col-md-3" >Link</button>
                  </div>
                  <div class="col-sm-8 col-xs-8" id="youtubeLink" style="display: none;">
                  </div>
                  <div class="col-sm-1 col-xs-1" id="removeBtn" style="display: none;">
                  </div>
                @else
                  <div class="col-sm-8 col-xs-8">
                    <span style="text-align:right;color:#fff;position: relative;float: right;">{{$musicCampaignAudio->youtube_feature}}</span>
                  </div>
                  <div class="col-sm-1 col-xs-1">
                    <span style="position: absolute;color:#fff;font-size:20px;margin-top: -5px;cursor: pointer;" class="remove-icon" onclick="removeSocialLink({{$musicCampaign->id}},'youtube')">x</span>
                  </div>
                @endif
              </div>
            </form>

            <form class="form-inline youtube_form" method="post"action="{{route('campaignaudio.instagram')}}">
              <div class="height-50 w-100 mt-2 row">
                <div class="col-sm-3 col-xs-3" style="color:white;">
                  <i class="fa fa-instagram mr-3" aria-hidden="true" style="color: rgb(224, 224, 224);font-size: 27px;position: relative;"></i>
                  <span style="margin-top: 4px;position: absolute;" class="social-text">Instagram</span>
                </div>
                @if($musicCampaignAudio->instagram==NULL)
                    <div class="col-sm-6 col-xs-6">
                      <input class="form-control text-social" type="text" name="instagram" value="" placeholder="Enter link" style="height: 27px;">
                    </div>
                    <div class="col-sm-3 col-xs-3">
                      <button type="submit" value="Submit" class="btn social-btn col-md-3">Link</button>
                    </div>
                @else
                  <div class="col-sm-8 col-xs-8">
                    <span style="text-align:right;color:#fff;position: relative;float: right;">{{$musicCampaignAudio->instagram}}</span>
                  </div>
                  <div class="col-sm-1 col-xs-1">
                    <span style="position: absolute;color:#fff;font-size:20px;margin-top: -5px;cursor: pointer;" class="remove-icon" onclick="removeSocialLink({{$musicCampaign->id}},'instagram')">x</span>
                  </div>
                @endif
              </div>
            </form>
            <form class="form-inline youtube_form" method="post"action="{{route('campaignaudio.facebook')}}">
              <div class="height-50 w-100 mt-2 row">
                <div class="col-sm-3 col-xs-3" style="color:white;">
                  <i class="fa fa-facebook-square mr-3" aria-hidden="true" style="color: rgb(224, 224, 224);font-size: 27px;position: relative;"></i>
                  <span style="margin-top: 4px;position: absolute;" class="social-text">Facebook</span>
                </div>
                @if($musicCampaignAudio->facebook==NULL)
                    <div class="col-sm-6 col-xs-6">
                      <input class="form-control text-social" type="text" name="facebook" value="" placeholder="Enter link" style="height: 28px;">
                    </div>
                    <div class="col-sm-3 col-xs-3">
                      <button type="submit" value="Submit" class="btn social-btn col-md-3">Link</button>
                    </div>
                @else
                  <div class="col-sm-8 col-xs-8">
                    <span style="text-align:right;color:#fff;position: relative;float: right;">{{$musicCampaignAudio->facebook}}</span>
                  </div>
                  <div class="col-sm-1 col-xs-1">
                    <span style="position: absolute;color:#fff;font-size:20px;margin-top: -5px;cursor: pointer;" class="remove-icon" onclick="removeSocialLink({{$musicCampaign->id}},'facebook')">x</span>
                  </div>
                @endif
              </div>
            </form>

            <style>
                .file-upload-wrapper {position: relative; width: 100%; height: 50px; }
                .file-upload-wrapper:after {content: attr(data-text); font-size: 14px; position: absolute; top: 0; left: 0; background: #898989; padding: 20px 12px; /* display: block; */ width: calc(100% - 130px); pointer-events: none; z-index: 20; height: 20px; line-height: 2px; border-radius: 1px; transition: background-color 0.2s ease;border-radius: 5px !important;opacity: 70%; }
                /* .file-upload-wrapper:hover:after {background: #202020; } */
                .file-upload-wrapper:before {content: 'Upload'; position: absolute; top: 0; right: 0; display: inline-block; height: 40px; color: #78FFFF; font-weight: 500; z-index: 25; line-height: 36px; padding: 0 25px; pointer-events: none; border: 2px solid rgb(132, 255, 255) !important;border-radius: 20px !important; }
                .file-upload-wrapper input {opacity: 0; position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 99; height: 40px; margin: 0; padding: 0; display: block; cursor: pointer; width: 100%; }
                .uploading:before { content: 'Uploading'; }
                .uploaded:before { content: 'Uploaded'; }
                .height-50 {height: 35px!important;}
            </style>

          </div>
        </div>
      </div>
    </div>

    <div id="cards-pad" class="row">
      <div class="card-deck mt-4 col-12 total_spins">
        <!-- MONEY EARNED CARD -->
        <div class="card height-160 {{$musicCampaign->total_spin == '' ? 'spins-data' : ''}}">
          <div class="card-body m-3">
            <div>
              <p class="card-text mt-2 spin-title" style="font-size: x-large; color:white">Total Spins</p>
            </div>
            <div class="mt-35">
              <div id="mydiv" class="float-left align-items-baseline mb-3">
                <h1 class="h1_font_size">{{$musicCampaign->total_spin}}</h1>
                <p class="text-muted" style="font-weight: bold;">Spins in Janaury</p>
              </div>
              <div id="mydiv1" class="float-right mt-3 width-35" style="text-align: center;color:rgb(132, 255, 255);">
                <span style="font-weight: bold; font-size: 25px;">-1</span> <br>
                <span class="text-muted" style="font-weight: bold;">since last week</span>
              </div>
            </div>
          </div>
        </div>

        <div class="card height-160 {{$musicCampaign->spin_rate == '' ? 'spins-data' : ''}}">
          <div class="card-body m-3" style="color:rgb(132, 255, 255);">
            <div>
              <p class="card-text mt-2 spin-title" style="font-size: x-large; color:white">Remaining Spins</p>
            </div>

            <div class="mt-35">
              <h1 class="float-left font-weight-bold h1_font_size mb-4" >@if($musicCampaign->spin_rate == 0)
                00
                @else
                <span id="user-balance">{{floor($musicCampaign->campaign_balance/$musicCampaign->spin_rate)}}</span>
                @endif</h1>
              <!-- <a style="color: #000;border: 1px solid;background: rgb(132, 255, 255);border-radius: 20px;padding: 10px 20px 10px 20px;" href="/payment/paypal" class="btn float-right add_funds_btn" role="button">Add funds</a> -->
              <a style="color: #000;border: 1px solid;background: rgb(132, 255, 255);border-radius: 20px;padding: 10px 20px 10px 20px;" class="btn float-right add_funds_btn" data-toggle="modal" id="addFund" data-target="#addFundModal">Add funds</a>
            </div>
          </div>
        </div>

        @if($musicCampaign->spin_rate == 0)
        <div class="card height-160 {{$musicCampaign->spin_rate == '' ? 'spins-data' : ''}}">
          <div class="card-body m-3" style="color:rgb(132, 255, 255);">
            <div>
              <p class="card-text mt-2 spin-title" style="font-size: x-large; color:white"> <span>spin rate</span></p>
              <!-- <p class="font-size-8">This is the amount that will be paid Djs each time they play your song</p> -->
            </div>

            <div class="mt-35">

              <div id="mydiv" class="dropdown setSpinRate float-left align-items-baseline full-continer">
                <!-- <form method="POST" action="/user/campaign/update" enctype="multipart/form-data">
                  <div class="full-continer user_spin_rate">
                    {{ csrf_field() }}
                    <label for="spinrate">Choose Rate</label>
                    <select name="spinrate" id="spinrate" class="form-control select-matirial-design" @if($musicCampaign->spin_rate)  disabled @endif>
                      <option value="10" @if($musicCampaign->spin_rate==10)  selected @endif>$10</option>
                      <option value="15" @if($musicCampaign->spin_rate==15)  selected @endif>$15</option>
                      <option value="20" @if($musicCampaign->spin_rate==20)  selected @endif>$20</option>
                      <option value="25" @if($musicCampaign->spin_rate==25)  selected @endif>$25</option>
                      <option value="30" @if($musicCampaign->spin_rate==30)  selected @endif>$30</option>

                    </select>
                    {{--<input type="number" name="spinrate" id="spinrate" class="form-control" placeholder="Spin Rate" required value="{{$musicCampaign->spin_rate}}" @if($musicCampaign->spin_rate)  disabled @endif>--}}
                    @if ($errors->has('spinrate'))
                    <span class="help-block has-error">
                                                        <strong>{{ $errors->first('spinrate') }}</strong>
                                                    </span>
                    @endif

                    <span class="help-block has-warning">
                                                        <strong>You can set spin rate only once</strong>
                                                </span>
                  </div>
                  <div>
                    <input type="Submit" class ="btn mt-4 float-right add_funds_btn" @if($musicCampaign->spin_rate)  disabled @endif value="SET">
                  </div>
                </form> -->
                <div class="full-continer user_spin_rate">
                  <span class="help-block has-warning">
                    <strong>You can set spin rate only once</strong>
                  </span>
                </div>
                <div>
                  <input type="Submit" class ="btn mb-3 float-right spain_rate_btn" @if($musicCampaign->spin_rate)  disabled @endif value="SET" data-toggle="modal" id="addSpainRate" data-target="#addSpainRateModal">
                </div>
              </div>
              <!-- <div id="mydiv1" class="float-right mt-3" >
                  <p class="card-text mt-2" style="font-size: x-large; color:white">${{$musicCampaign->spin_rate}}/SPIN</p>
                  <a style="color: rgb(132, 255, 255); border: 1px solid;" href="#" class="btn mt-4 float-right add_funds_btn" role="button">SET</a>
              </div> -->


            </div>
            <br>
            <br>
            <div id="mydiv1">
              <!-- <p class="font_11_mt">*You can only set your spin rate once</p> -->
            </div>
          </div>
        </div>
        @else
        <div class="card height-160 {{$musicCampaign->spin_rate == '' ? 'spins-data' : ''}}">
          <div class="card-body m-3" style="color:rgb(132, 255, 255);">
            <div>
              <p class="card-text mt-2" style="font-size: x-large; color:white"> <span>spin rate</span></p>
              <!-- <p class="font-size-8">This is the amount that will be paid Djs each time they play your song</p> -->
            </div>

            <div class="mt-35">

              <div id="mydiv" class="dropdown setSpinRate float-left align-items-baseline full-continer">
                <h1 class="h1_font_size mb-4">${{$musicCampaign->spin_rate}}/Spin</h1>
              </div>
              <!-- <div id="mydiv1" class="float-right mt-3" >
                  <p class="card-text mt-2" style="font-size: x-large; color:white">${{$musicCampaign->spin_rate}}/SPIN</p>
                  <a style="color: rgb(132, 255, 255); border: 1px solid;" href="#" class="btn mt-4 float-right add_funds_btn" role="button">SET</a>
              </div> -->


            </div>
            <br>
            <br>
            <div id="mydiv1">
              <!-- <p class="font_11_mt">*You can only set your spin rate once</p> -->
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="card-deck col-12 advance_filter">
      <div class="col-sm-6 col-12 mt-5">
        <div class="card p-4 ml-0 mr-0">
          <span style="position: relative;">UPLOAD VERSIONS <span style="float: right;font-size: 25px;"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></span>
          <div class="row d-flex">
            <div class="col-md-12 mt-3">
              <div class="file-upload-wrapper" data-text="Acapella Version">
                <form method="POST" id="acappella-form" class="audio-form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" value="acappella" name="musicType">
                  <input name="audio" id="acappellaUpload" type="file" class="file-upload-field" value="">
                </form>
              </div>
            </div>
            <div class="col-md-12 mt-3">
              <div class="file-upload-wrapper" data-text="Radio Version">
                <form method="POST" id="radio-form" class="audio-form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" value="radioversion" name="musicType">
                  <input name="audio" id="radioUpload" type="file" class="file-upload-field" value="">
                </form>
              </div>
            </div>
            <div class="col-md-12 mt-3">
              <div class="file-upload-wrapper" data-text="Instrumental Version">
                <form method="POST" id="instrumental-form" class="audio-form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" value="instrumental" name="musicType">
                  <input name="audio" id="instrumentalUpload" type="file" class="file-upload-field" value="">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-12 mt-5 sm-plpr-0 iframe-mobile-manager">
        <div class="card p-4 ml-0 mr-0 video-section" id="youtubeURL">
          <span class="mb-3" style="position: relative;" >YOUTUBE VIDEO</span>
          @if($musicCampaignAudio->youtube_feature != null)
            @php
            $url = $musicCampaignAudio->youtube_feature;
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/
            ]{11})%i', $url, $match);
            $youtubeId = $match[1];
            @endphp
            <iframe width="100%" height="220" src="https://www.youtube.com/embed/{{$youtubeId}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          @else
              <img src="/img/play-hover.png" width="70" height="70" class="youtube-video" id="youtubeVideo">
          @endif
        </div>
      </div>
    </div>
    
    <div class="card-deck mt-4 col-12 upload_dj">
      <div id="players-pad" style="width: 100%;" class="ml-5 mt-0">
        <h2>Upload for DJs</h2>
        <div class="row d-flex">
          @if($acappella!=null)
          <div class="col-md-4" id="uploadRadio">
            <h4 style=" color:rgb(132, 255, 255);">Radio</h4>
            <audio controls>
              <source src="/{{$acappella->song_path}}" type="audio/mpeg">
            </audio>
          </div>
          @endif

          @if($radio!=null)
          <div class="col-md-4" id="uploadAcapella">
            <h4 style=" color:rgb(132, 255, 255);">Acapella</h4>
            <audio controls>
              <source src="/{{$radio->song_path}}" type="audio/mpeg">
            </audio>
          </div>
          @endif

          @if($instrumental!=null)
          <div class="col-md-4" id="uploadInstrumental">
            <h4 style=" color:rgb(132, 255, 255);">Instrumental</h4>
            <audio controls>
              <source src="/{{$instrumental->song_path}}" type="audio/mpeg">
            </audio>
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- CARD DECK 1 END -->

    <!-- CARD DECK 2 START -->

  </div>

  @if($musicCampaign->target_country != '[]' ||sizeof(json_decode($musicCampaign->target_country))>0)
  @for ($i = 0; $i < sizeof(json_decode($musicCampaign->target_country)); $i++)
  <script>
      var country = null;
      @if(json_decode($musicCampaign->target_country)[$i]!=0) {
          {{--                        alert({{json_decode($musicCampaign->target_country)[$i]}});--}}
          country = '{{App\Country::find(json_decode($musicCampaign->target_country)[$i])['name']}}';
      }
      @endif
      var state = null;
      var city = null;
      var coliation = null;
      @if(json_decode($musicCampaign->target_state)[$i]!=0) {
          {{--                            alert({{json_decode($musicCampaign->target_state)[$i]}});--}}
          state = '{{App\State::find(json_decode($musicCampaign->target_state)[$i])['name']}}';
      }
      @endif

      @if(json_decode($musicCampaign->target_city)[$i]!=0) {
          city = '{{App\City::find(json_decode($musicCampaign->target_city)[$i])['name']}}';
      }
      @endif
      @if(json_decode($musicCampaign->target_colition )[$i]!=0) {
          coliation = '{{App\DjManager::find(json_decode($musicCampaign->target_colition)[$i])['company_name']}}';
      }
      @endif
      countrySelected.push({{json_decode($musicCampaign->target_country)[$i]}});
      stateSelected.push({{json_decode($musicCampaign->target_state)[$i]}});
      citySelected.push({{json_decode($musicCampaign->target_city)[$i]}});
      collationSelected.push({{json_decode($musicCampaign->target_colition)[$i]}});
      var cardHtml = '   <div class="col-md-6 col-sm-6">\n' +
          '\n' +
          '<div class="card"  id="card' + indices + '">\n' +
          ' <div class="container"><i class="fa fa-trash" style="margin-right: 10px;margin-top: 10px;float: right;" data-toggle="tooltip" data-placement="top" title="Remove filter!"  onclick="deleteCard(' + indices + ')"></i> ' +
          '<center> <h3>Filter </h3></center>\n';

      indices++;
      if (country) {
          cardHtml = cardHtml + '<p>Country :' + country + '</p>';
          if (state) {
              cardHtml = cardHtml + '<p>State :' + state + '</p>';
              if (city) {
                  cardHtml = cardHtml + '<p>City :' + city + '</p>';
              }
              else {
                  cardHtml = cardHtml + '<p>City :' + '---' + '</p>';
              }
          }
          else {
              cardHtml = cardHtml + '<p>State :' + '---' + '</p><p>City :---</p>';
          }
      }
      else {
          cardHtml = cardHtml + '<p>Country :' + '---' + '</p><p>State :---</p><p>City :---</p>';
      }
      if (coliation) {
          cardHtml = cardHtml + '<p>Collation :' + coliation + '</p>';
      }
      else {
          cardHtml = cardHtml + '<p>Collation :' + '---' + '</p>';
      }
      cardHtml = cardHtml + '</div>\n' +
          '                        </div>\n' +
          '                        </div>';
      $("#advCountry").prop("selectedIndex", 0);
      $("#advState").prop("selectedIndex", 0);
      $("#advCity").prop("selectedIndex", 0);
      $("#advCoalition").prop("selectedIndex", 0);
      var originalHtml = $('#selectedFilters').html();
      originalHtml = originalHtml + cardHtml;
      $('#selectedFilters').html(originalHtml);

  </script>
  @endfor
  <script>
      loadDataAdvanced();
  </script>
  @endif
  <!-- CARD DECK 2 END -->
  <div class="content row pt-0 mt-4">
    <div class="col-12 pl-15 table_layout">
      <div class="card p-3 ml-2 mr-4">
        <p class="mt-4" style="font-size: 17px; color:#FFF;margin:10px;position: absolute;">CAMPAIGN STATZ</p>
        <p class="m-0">
          <input type="text" class="form-control text-search" name="txtSearch" id="txtSearch" placeholder="Search" style="width: 20%;">
          <i class="fa fa-search search-icon" aria-hidden="true" style="position: absolute;padding-left: 80%;padding-top: 12px;"></i>
        </p>
      </div>
      <table class="col-12 mb-4 mt-0 ml-3 mr-4" role="table" style="width:97%;">
        <thead role="rowgroup">
        <div class="row">
          <tr role="row">
            <th role="columnheader" >&nbsp;</th>
            <th role="columnheader" >DJ Name</th>
            <th role="columnheader" >City</th>
            <th role="columnheader" >Club</th>
            <th role="columnheader" >Capacity</th>
            <th role="columnheader" >LW Spins</th>
            <th role="columnheader" >TW Spins</th>
            <th role="columnheader" >Total Spin</th>
            <th role="columnheader" ><i class="fa fa-arrow-circle-down"></i></th>
            <th role="columnheader" >Manager</th>

          </tr>
        </div>
        </thead>
        <tbody style="border-bottom: 1px solid grey;" role="rowgroup" class="spin-details">

        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Add Fund Modal -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="addFundModal">
    <div class="modal-dialog" role="document">
        
    </div>
</div>
<!-- End Modal -->

<!-- Spain rate Modal -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="addSpainRateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content spain-rate-modal">
      <div class="modal-header" style="border-bottom: 0;padding: 20px;">
        <h5 class="modal-title" style="font-size: 20px;">Set spin rate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: inherit;">
        </button>
      </div>
      <div class="modal-body" style="padding: 20px;">
        <form method="POST" action="/user/campaign/update" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div>
            <span style="font-size: 13px;line-height: 18px;">Please adjust the amount DJs will earn each time they play your music. <span style="color:#FA3131;">Please note that this rate can be set only once.</span></span>
          </div>
          <div class="form-group mt-4  col-xs-12 pl-0">
            <select name="spinrate" id="spinrate" class="select-spain-rate"  @if($musicCampaign->spin_rate)  disabled @endif>
              <option value="">Select a spin rate</option>
              <option value="10" @if($musicCampaign->spin_rate==10)  selected @endif>$10</option>
              <option value="15" @if($musicCampaign->spin_rate==15)  selected @endif>$15</option>
              <option value="20" @if($musicCampaign->spin_rate==20)  selected @endif>$20</option>
              <option value="25" @if($musicCampaign->spin_rate==25)  selected @endif>$25</option>
              <option value="30" @if($musicCampaign->spin_rate==30)  selected @endif>$30</option>
            </select>

          </div>
          <button class="btn mt-3 btn-spain" type="submit">Set</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<style>
.spain-rate-modal {
  margin-top: 40%;
  width: 402px;
  border-radius: 10px;
  background: #060606;
  left: 90px;
}
.btn-spain {
  width: 180px;
  height: 40px;
  background: #93E5E5;
  border-radius: 50px;
  margin-left: 95px;
}
.select-spain-rate {
  background: #4F4F4F;
  opacity: 0.4;
  border-radius: 6px;
  height: 44px;
  width: 334px;
  padding: 10px;
}
.spain_rate_btn {
  color: rgb(132, 255, 255) !important;
  border: 1px solid;
  margin-left: 10px;
}
</style>

<script src="/js/campaign/dashboard.js"></script>
<!--<script src="/js/campaign/graph.js"></script>-->
<!--<script src="/js/locationchooser.js"></script>-->

@section('custom_js')
<script type="text/javascript">
    /**
     *
     * @param amount
     */
    $(document).ready(function(){
        $('#addFund').on('click', function(){
            var base_url = "<?php echo url('/campaign/new/create'); ?>";
            $.get( base_url, function( data ) {
                //alert(data);
                $('#addFundModal .modal-dialog').html(data);
            });
        });

        $("#youtubeForm").validate({
          rules: {
            youtube: {
              required: true,
            },
          },
          messages: {
            youtube: {
              required: 'This field is required.',
            },
          },
          submitHandler: function(form)
          {
            $.ajax({
                type: "POST",
                url: '/campaign/youtube',
                data: { youtube : $("#youtube").val() },
                dataType: 'json',
                // contentType: false,
                // processData: false,
                success : function(res) {
                  console.log(res.youtube_url);
                  if(res.status == 'success') {
                    $("#addYoutube").css('display', 'none');
                    $("#youtubeBtn").css('display', 'none');
                    $("#youtubeLink").css('display', 'block');
                    $("#removeBtn").css('display', 'block');

                    $("#youtubeLink").html('<span style="text-align:right;color:#fff;position: relative;float: right;">'+res.youtube_feature+'</span>');
                    $("#removeBtn").html('<span style="position: absolute;color:#fff;font-size:20px;margin-top: -5px;cursor: pointer;" class="remove-icon" onclick="removeSocialLink('+res.campaignID+',youtube)">x</span>');

                    $("#youtubeURL").html('<span class="mb-3" style="position: relative;" >YOUTUBE VIDEO</span><iframe width="100%" height="220" src="https://www.youtube.com/embed/'+res.youtube_url+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
                  }
                  else {

                  }
                }
            });
          }
        });
    });

    $(document).ready(function() {
        $(".campaign-select").change(function() {
            //alert(this.value)
            url = "/campaign/use/" + this.value

            $.get(url, function(data) {
                location.reload();
            });
        });

        country = $('.countryOption').attr("val");
        state = $('.stateOption').attr("val");
        city = $('.cityOption').attr("val");
        coalition = $('.coalition').attr("val");
        //loadData(country, state, city, coalition)
        url = '/campaign/thisweek/{{$musicCampaign->id}}'


        $.get(url, function(data) {
            $('.this-week').text(data)
        });

        // $('#lowBalanceModal').modal('show');

    });


    // $(document).on('change', ".filter", function () {
    //  country = $(".countryOption option:selected").val();
    //  state = $(".stateOption option:selected").val();
    //  city = $(".cityOption option:selected").val();
    //  coalition = $(".coalition option:selected").val();
    //  loadData(country, state, city, coalition)
    // });
</script>
@endsection
@endsection

<script>
    var countrySelected = [];
    var stateSelected = [];
    var citySelected = [];
    var collationSelected = [];
    var indices = 0;
    var deleteIndices = [];

    function loadDataAdvanced() {
        var countrySelectedCopy = countrySelected.slice();
        var stateSelectedCopy = stateSelected.slice();
        var citySelectedCopy = citySelected.slice();
        var collationSelectedCopy = collationSelected.slice();
        for (var i = deleteIndices.length - 1; i >= 0; i--) {
            countrySelectedCopy.splice(deleteIndices[i], 1);
            stateSelectedCopy.splice(deleteIndices[i], 1);
            citySelectedCopy.splice(deleteIndices[i], 1);
            collationSelectedCopy.splice(deleteIndices[i], 1);

        }
        //console.log(countrySelected, stateSelected, citySelected, collationSelected);
        $.ajax({
            url: '/campaign/advancedEstimation',
            type: 'POST',
            dataType: 'json',
            // data: {country:abc},
            data: {
                country: JSON.stringify(countrySelectedCopy),
                state: JSON.stringify(stateSelectedCopy),
                city: JSON.stringify(citySelectedCopy),
                collation: JSON.stringify(collationSelectedCopy)
            },
            success: function(data) {
                $("#cCountry").text(data[0] == 'undefined' ? '--' : data[0])
                $("#cState").text(data[1] == 'undefined' ? '--' : data[1])
                $("#cCity").text(data[2] == 'undefined' ? '--' : data[2])
                $("#cCoalition").text(data[3] == 'undefined' ? '--' : data[3])
                $("#cTotal").text(data[4] == 'undefined' ? '--' : data[4])
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });

    }

    function loadData(country, state, city, coalition) {
        // console.log(country, state, city, coalition)
        url = '/campaign/estimation?' + 'country=' + country + '&state=' + state + '&city=' + city + '&coalition=' + coalition
        //console.log(url)

        $.get(url, function(data) {
            //console.log(data)
            $("#cCountry").text(data[0] == 'undefined' ? '--' : data[0])
            $("#cState").text(data[1] == 'undefined' ? '--' : data[1])
            $("#cCity").text(data[2] == 'undefined' ? '--' : data[2])
            $("#cCoalition").text(data[3] == 'undefined' ? '--' : data[3])
            $("#cTotal").text(data[4] == 'undefined' ? '--' : data[4])
        });
    }

    /**
     * User balance every 30 sec update
     */
    function userBalance() {
        url = "/user/campaign/balance";
        jQuery.ajax({
            url: url,
            type: 'get',
            success: function(response) {
                // Perform operation on the return value
                if (response && response.campaign_balance) {
                    $("#user-balance").text(Math.floor(response.campaign_balance / response.spin_rate));
                }
                if (response && response.spin_rate) {

                    $("#spin-rate").text(response.spin_rate);
                }
            }
        });
    }

    function addToAdvanced() {
    @if($totalSpent < 1000)
        alert("You must spent atleast $1000 to enable this feature");
        return 0;
        @endif

        var selected_country = $('#advCountry option:selected');
        var selected_state = $('#advState option:selected');
        var selected_city = $('#advCity option:selected');
        var selected_collation = $('#advCoalition option:selected');
        var found = false;

        var countrySelectedCopy = countrySelected.slice();
        var stateSelectedCopy = stateSelected.slice();
        var citySelectedCopy = citySelected.slice();
        var collationSelectedCopy = collationSelected.slice();
        for (var i = deleteIndices.length - 1; i >= 0; i--) {
            countrySelectedCopy.splice(deleteIndices[i], 1);
            stateSelectedCopy.splice(deleteIndices[i], 1);
            citySelectedCopy.splice(deleteIndices[i], 1);
            collationSelectedCopy.splice(deleteIndices[i], 1);

        }


        var selectCountryval = selected_country.val() ? parseInt(selected_country.val()) : 0;
        var selectStateval = selected_state.val() ? parseInt(selected_state.val()) : 0;
        var selectCityval = selected_city.val() ? parseInt(selected_city.val()) : 0;
        var selectCollationval = selected_collation.val() ? parseInt(selected_collation.val()) : 0;
        for (var i = 0; i < countrySelectedCopy.length; i++) {
            // alert(selectCountryval+selectStateval+selectCityval+selectCollationval);
            if (selectCountryval === countrySelectedCopy[i] && selectCityval === citySelectedCopy[i] && selectStateval === stateSelectedCopy[i] && selectCollationval === collationSelectedCopy[i]) {
                found = true;
            }
        }
        if (found) {
            $('#advancedCampModal').modal('show');
        } else {
            var cardHtml = '   <div class="col-md-6">\n' +
                '\n' +
                '<div class="card"  id="card' + indices + '">\n' +
                ' <div class="container"> <i class="fa fa-trash" style="margin-right: 10px;margin-top: 10px;float: right" data-toggle="tooltip" data-placement="top" title="Remove filter!"  onclick="deleteCard(' + indices + ')"></i> ' +
                '<center> <h3>Filter </h3></center>\n';

            // deleteCard(\''+selected_country.size()+'\')
            if (selected_country.val() || selected_collation.val()) {
                indices++;
                if (selected_country.val()) {
                    countrySelected.push(parseInt(selected_country.val()));
                    cardHtml = cardHtml + '<p>Country :' + selected_country.text() + '</p>';
                    if (selected_state.val()) {
                        stateSelected.push(parseInt(selected_state.val()));
                        cardHtml = cardHtml + '<p>State :' + selected_state.text() + '</p>';
                        if (selected_city.val()) {
                            citySelected.push(parseInt(selected_city.val()));
                            cardHtml = cardHtml + '<p>City :' + selected_city.text() + '</p>';
                        } else {
                            cardHtml = cardHtml + '<p>City :' + '---' + '</p>';
                            citySelected.push(0);
                        }
                    } else {
                        citySelected.push(0);
                        stateSelected.push(0);
                        cardHtml = cardHtml + '<p>State :---</p><p>City :---</p>';
                    }
                } else {
                    countrySelected.push(0);
                    stateSelected.push(0);
                    citySelected.push(0);
                    cardHtml = cardHtml + '<p>Country :' + '---' + '</p><p>State :---</p><p>City :---</p>';
                }
                if (selected_collation.val()) {
                    collationSelected.push(parseInt(selected_collation.val()));
                    cardHtml = cardHtml + '<p>Collation :' + selected_collation.text() + '</p>';
                } else {
                    collationSelected.push(0);
                    cardHtml = cardHtml + '<p>Collation :' + '---' + '</p>';
                }
                cardHtml = cardHtml + '</div>\n' +
                    '                        </div>\n' +
                    '                        </div>';
                $("#advCountry").prop("selectedIndex", 0);
                $("#advState").prop("selectedIndex", 0);
                $("#advCity").prop("selectedIndex", 0);
                $("#advCoalition").prop("selectedIndex", 0);
                var originalHtml = $('#selectedFilters').html();
                originalHtml = originalHtml + cardHtml;
                $('#selectedFilters').html(originalHtml);
                loadDataAdvanced();
                sendData();
            }
        }
    }

    function deleteCard(indx) {
        var cardId = 'card' + indx;
        $('#' + cardId).remove();
        deleteIndices.push(indx);
        loadDataAdvanced();
        sendData();
    }

    function advancedCampaign() {
        url = "/user/campaign/balance";
        jQuery.ajax({
            url: url,
            type: 'get',
            success: function(response) {
                // Perform operation on the return value
                if (response && response.campaign_balance) {
                    $("#user-balance").text(response.campaign_balance);
                }
                if (response && response.spin_rate) {
                    $("#spin-rate").text(response.spin_rate);
                }
            }
        });
    }

    function sendData() {
        $("#advCountry").prop("selectedIndex", 0);
        $("#advState").prop("selectedIndex", 0);
        $("#advCity").prop("selectedIndex", 0);
        $("#advCoalition").prop("selectedIndex", 0);
        deleteIndices.sort(function(a, b) {
            return a - b
        });
        console.log(deleteIndices);
        var countrySelectedCopy = countrySelected.slice();
        var stateSelectedCopy = stateSelected.slice();
        var citySelectedCopy = citySelected.slice();
        var collationSelectedCopy = collationSelected.slice();
        for (var i = deleteIndices.length - 1; i >= 0; i--) {
            countrySelectedCopy.splice(deleteIndices[i], 1);
            stateSelectedCopy.splice(deleteIndices[i], 1);
            citySelectedCopy.splice(deleteIndices[i], 1);
            collationSelectedCopy.splice(deleteIndices[i], 1);

        }
        console.log(countrySelected);
        $.ajax({
            url: '/campaign/advancedFilter',
            type: 'POST',
            dataType: 'json',
            // data: {country:abc},
            data: {
                country: JSON.stringify(countrySelectedCopy),
                state: JSON.stringify(stateSelectedCopy),
                city: JSON.stringify(citySelectedCopy),
                collation: JSON.stringify(collationSelectedCopy)
            },
            success: function(response) {
                if (response.success === 'success') {
                    // deleteIndices.length=0;
                    // $('#myModal').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    jQuery(document).ready(function() {
        setInterval(userBalance, 30000);

        $(".audio-form input[type=file]").on("change", function(e) {
            var $this = $(this);
            var form = $this.closest('form');
            var closestRow = form.closest('.file-upload-wrapper');
            // you can't pass Jquery form it has to be javascript form object
            var formData = new FormData(form[0]);
            closestRow.removeClass('uploaded').addClass('uploading');
            
        });
    });

    function fnCalculateAmount(amount) {

        var fixedPer = 4.4;
        var transactionFee = ((amount * fixedPer) / 100).toFixed(0);
        var totalAmount = amount * 1 + transactionFee * 1;

        $("#transaction_fee").text('$' + transactionFee);
        $("#hdn_transaction_fee").val(transactionFee);

        $("#total_amount").text('$' + totalAmount);
        $("#hdn_total_amount").val(totalAmount);
    }

    function removeSocialLink(campaing_id, key) {
      $.ajax({
        type: "POST",
        url: '/campaign/deleteSocialLink',
        data: { campaing_id:campaing_id, key:key },
        dataType: 'json',
        success : function(res){
          if (res.success == 'success') {
            window.location.reload();
            // if(key == 'youtube') {
            //   $("#addYoutubeLink").css('display', 'block');
            //   $("#removeYoutubeLink").css('display', 'none');
            // } else if(key == 'instagram') {
            //   $("#addInstagramLink").css('display', 'block');
            //   $("#removeInstagramLink").css('display', 'none');
            // } else {
            //   $("#addFacebookLink").css('display', 'block');
            //   $("#removeFacebookLink").css('display', 'none');
            // }
          }
        }
      });
    }
</script>
