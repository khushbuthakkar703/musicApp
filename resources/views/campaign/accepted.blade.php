@extends('layouts.djapp')
@section('content')
<title>SpinStatz | Accepted Campaign</title>
  <br>
<link rel="stylesheet" type="text/css" href="/css/custom.css" />
 
<main class=" mdl-layout__content mdl-color--grey-800 pl-3 mt-n4 custom_post_bade accept_blade">
    <!-- Begin Stats Section --------------------------------------------------------------------------------------------->
    <div class="hero-background">
      <div class="content">
        <!-- Spinstatz DJ Dashboard Heading -->
        <div class="mdl-grid mb-3">
          <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
            <h3 style="font-weight: bold;">All your Song</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- End Stats Section ----------------------------------------------------------------------------------------------->
    <!-- Begin Album Section -------------------------------------------------------------------------------------------------->
    <div id="gen" class="content pt-0">
      <!-- Begin Sorting Section ---------------------------------------------------------------------------------------------->
      <div class="mdl-grid lib_filter">
        <!-- Begin Full Width Column ---------------------------------------------------------------------------------------------->
        <!-- Genre <select>    -->
	        <div class="dropdown dropdown-menu-handler">
            <select name="select-genere">
                <option value="">Select Genre</option>
                @foreach($genres as $genre)
                  <option value="{{$genre->music_type}}">{{$genre->name}}</option>
                  </span>
                @endforeach
            </select>
	          <input id="wid_search" class="wid_search first_serach" value="{{ Request::get('searchBy') }}" type="text" placeholder="Search" aria-label="Search">
	        </div>

        <!-- Filtering buttons -->
          <span class="type-filter">
    	  <div id="active_buttons" class="btn-toolbar sm-mb-0 sm-mt-10" style="margin-left: 0;">
          <a href="/dj/accepted/campaign/?filterBy=bpm">
            <button class="btn btn-lg {{ Request::get('filterBy')=='bpm'?'active':'' }}">
              BPM
            </button>
          </a>
	      </span>
	        <span class="type-filter spin_price">
	        <a href="/dj/accepted/campaign/?filterBy=rate">
	          <button class="btn btn-lg {{ Request::get('filterBy')=='rate'?'active':'' }}">
	            $ / Spin
	          </button>
	        </a>
	      </span>

	     {{--Working -- Start--}}
	     <span class="type-filter">
	     <a href="/dj/accepted/campaign/?filterBy=likes">
	          <button class="btn btn-lg {{ Request::get('filterBy')=='likes'?'active':'' }}">
	            Likes
	          </button>
	        </a>
	      </span>
        {{--Working -- End--}}

        <a href="/dj/accepted/campaign/?filterBy=mostPlayed">
          <button class="btn btn-lg btn-lg-lg {{ Request::get('filterBy')=='mostPlayed'?'active':'' }}">
            Most Played
          </button>
        </a>
        <!-- Search form -->
        <input id="wid_search"  class="wid_search last_search" value="{{ Request::get('searchBy') }}" type="text" placeholder="Search" aria-label="Search">
        <!-- <div class="row">
              <div class="pull-right widget_search">
                <label>Search:</label>
                <span id="search_loader" style="color: #fff;"></span>
                <input id="wid_search" type="text" name="widget_search">
              </div>
            </div>-->

      </div>
      <!-- End Full Width Column ------------------------------------------------------------------------------------------------>
    </div>

    <div class="container margin-over pl-0 sm-pr-0 full-container-width">
        <div class="col-md-12 pl-0 sm-pr-0">
        	<div class="col-md-8 replaceHtmlHandler">
	        	@foreach($accepted as $campaign)
	            <div class="col-md-6 campaign_song_box">
	            	<div class="bg_mange">
		            	<div class="com-md-12 d-flex">
	                    <a href="/dj/campaign/{{$campaign->campaign_id}}">{{$campaign->campaign_name }}</a>
	                    <span class="pull-right">${{$campaign->spin_rate/2}}/Spin</span>
	                    </div>
	                    <div class="col-md-12 box-image">
	                    	<img src="/{{$campaign->artwork}}"alt="{{$campaign->campaign_name }}" height="75"class="artist-image"> 
	                    </div>
                    </div>
	            </div> 
	            @endforeach  
            </div>
            <div class="col-md-4 capsong_info_box">
                <div class="card-body m-3">
                    <div>
                        <p class="card-text mt-2">Info box</p>
                        <div class="panel-heading">
                            All your songs can be played by Djs, but they will only get paid when they play a song campaign.
                        </div>
                        <div class="panel-heading">
                            To get played more often and to receive detailed Stats make sure to top up empty song Budgets and keep them as campaigns
                        </div>
                    </div>
                </div> 
	        </div>    
        </div> 
    </div>  
    <div>
        <p></p>
    </div> 
    
  <!-- End Album Section ------------------------------------------------------------------------------------------------>
  </main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
    // document.getElementsByClassName("accepted")[0].classList.add('active');
    // jQuery(function($){
    //   $(document).on('click','.dropdown-menu-handler #dropdownMenuButton',function(){
    //     var $this = $(this);
    //     var closestRoww = $this.closest('.dropdown-menu-handler');
    //     closestRoww.find('.dropdown-menu').slideToggle();
    //   });
    // });


    $(document).ready(function() {
    
      $(document).on('keyup','.wid_search', function() {
          var searchKeyword = $(this).val();
          console.log(searchKeyword);
          if (searchKeyword.length >= 2) {
            $.ajax({
              type: 'get',
              url: '/dj/accepted/campaign/?searchBy='+searchKeyword,
              data: {
                searchKeyword: searchKeyword
              },
              success: function(res) {
                $(document).find('.replaceHtmlHandler').html($(".replaceHtmlHandler", res).html());
              }
            });
          }
      });

      $(document).on('change','.dropdown-menu-handler select', function() {
          var searchKeyword = $(this).val();
          $.ajax({
            type: 'get',
            url: '/dj/accepted/campaign/?genereBy='+searchKeyword,
            data: {
              searchKeyword: searchKeyword
            },
            success: function(res) {
              $(document).find('.replaceHtmlHandler').html($(".replaceHtmlHandler", res).html());
            }
          });
      });


    });
</script>
@endsection