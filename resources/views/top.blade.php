<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui">
    
    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="600">
    <meta property="og:description" content="">
    
    <meta name="msapplication-TileColor" content="#262626">
    <link rel="stylesheet" type="text/css" href="https://spinstatz.net/css/ts_plugs.min.css?ts=1493153700">
    <link rel="stylesheet" type="text/css" href="https://spinstatz.net/css/ts_index.min.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald:700,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:700,400' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" type="text/css" href="https://spinstatz.net/css/youtube.css">
    <link href='https://fonts.googleapis.com/css?family=Noto+Sans:700,400' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://spinstatz.net/js/ts_plugs.min.js"></script>
    <script type="text/javascript" src="https://spinstatz.net/js/playlist.ts.v2.min.js"></script>
    <script type="text/javascript" src="https://spinstatz.net/js/global.min.js"></script>
    <script type="text/javascript" src="https://spinstatz.net/js/tsmain.min.js"></script>
    <script type="text/javascript" src="https://spinstatz.net/js/tspage.min.js"></script>
    
    
  </head>
  <body>
    <div id="mainBay">
<div id="bodyBay" class="v-" data-init_cpo=""><script type="text/javascript">$(function(){enablePageFrontGenre();});</script>
      <div class="genre-hdr">
        <h1 class="genre-id" data-gid=""></h1>
      </div>
      <div id="ttAndGridCont" class="front-split fs-left v-">
        <div id="topTenBay" class="v-">
          <div class="top-ten-hdr">
            <span class="dim"> <img src="https://spinstatz.net/img/newestlogosmall.png" width="180" height="42" alt=""/></span> TOP 10 SONGS
            <div class="com-pall">
              <a href="javascript:void(0)" class="com-play-all" title="Play All">
              </a>
              <a href="javascript:void(0)" class="com-pl-all" title="Add All to Playlist">
              </a>
            </div>
          </div>
          <div id="ttListCont" class="v-">
            <?php $i=1; ?>
            @foreach($topSongs as $song)
            <div  class="top-item play-trk ptk-5648318">
              <div class="ttib position">{{$i}}
              </div><div class="image"><img style="height: 50px;object-fit: cover;" src="{{asset($song->artwork)}}" />
              <div class="img-fly">
              </div></div><div class="ttib info">
              <a href="javascript:void(0);" class="com-title">{{$song->song_title}}</a><br />
              <a href="javascript:void(0);" class="com-artists">{{$song->artist_name}}</a><br />
              <a href="#" class="com-label">{{$song->company_name}}</a>
            </div>
          </div>
          <?php $i++; ?>
          @endforeach
          
        </div>
        <!--No CRs or spaces here!--></div>
      </div><div class="front-split fs-main v-">

      <!--No CRs or spaces here!-->
  <div id="frontGridBay" class="v-">
      <div class="front-djc-grid com-grid six v- init-invis">
        <div class="grid-hdr">
          <!--<a href="javascript:void(0)" class="menu-btn"></a>
          <div class="compact-mn-cont"></div>-->
          <a href="javascript:void(0);" class="name-hdr ellip">TOP PERFORMING DJS</a>
          <div class="com-pall grid-mn-itm">
            <a href="javascript:void(0)" class="com-play-all"></a>
            <a href="javascript:void(0)" class="com-pl-all" ></a>
          </div>
          <a href="javascript:void(0);" class="com-see-all grid-mn-itm"></a>
        </div>
        <div class="grid-cont">
          <div class="grid-page">
          @foreach($topDjs as $dj)
            <div class="grid-item play-ttl ptl-1039059" data-tid="1039059">
              <div class="grid-image">
                <a href="javascript:void(0);"><img style="height: 140px;object-fit: cover;" src="{{asset($dj->profile_picture)}}" /></a>
              </div>
              <div class="links ellip">
                <a href="javascript:void(0);" class="com-title">{{$dj->dj_name}}</a>
                {{$dj->city_name}}

                <div>{{$dj->country}}</div>

                <div>{{"@".$dj->instagram}}</div>

              </div>
            </div>
           @endforeach 
          </div> <div class="video-container"><iframe width="853" height="480" src="https://www.youtube.com/embed/VdbF52hpfC8" frameborder="0" allowfullscreen</iframe></div>
        </div>
		 
      </div>
      <div class="grid-footer"> </div>
    </div>      
</body>
</html>
