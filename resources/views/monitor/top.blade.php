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
            <span class="dim">SPINSTATZ</span> TOP 10 SONGS
            <div class="com-pall">
              <a href="javascript:void(0)" class="com-play-all" title="Play All">
              <svg class="playil-svg"><use xlink:href="/img/vects.v2.svg#play-inline"></use></svg>
            </a>
            <a href="javascript:void(0)" class="com-pl-all" title="Add All to Playlist">
            <svg class="plil-svg"><use xlink:href="/img/vects.v2.svg#pl-inline"></use></svg>
          </a>
        </div>
      </div>
      <div id="ttListCont" class="v-">
      <?php $i=1; ?>
      @foreach($songs as $song)
        <div data-trid="5648318" class="top-item play-trk ptk-5648318">
          <div class="ttib position">{{$i}}
          </div><div class="image"><img src="{{asset($song->artwork)}}" />
          <div class="img-fly">
          </div></div><div class="ttib info">
          <a href="" class="com-title">{{$song->song_title}}</a><br />
          <a href="{{url('dj/campaign/'.$song->id)}}" class="com-artists">{{$song->campaign_name}}</a><br />
          <a href="#" class="com-label">{{$song->artist_name}}</a>
        </div>
      </div>
      <?php $i++; ?>
      @endforeach
    
</div>
<div class="scab-left"><iframe width="400" height="315" src="https://www.youtube.com/embed/XEXLLnwoY20" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
<!--No CRs or spaces here!--></div>
</div><div class="front-split fs-main v-"><img src="/images/DB.jpg" width="550 height="406" alt=""/>
<!--No CRs or spaces here!--><div id="frontGridBay" class="v-">
<div class="front-djc-grid com-grid six v- init-invis">
<div class="grid-hdr">
<!--<a href="javascript:void(0)" class="menu-btn"></a>
<div class="compact-mn-cont"></div>-->
<a href="/dj-top-10s" class="name-hdr ellip">TOP PERFORMING DJS</a>
<div class="com-pall grid-mn-itm">
<a href="javascript:void(0)" class="com-play-all" data-titles=1039059,1040312,1039465,1038478,1037797,1039585><svg class="pall-svg"><use xlink:href="/img/vects.v2.svg#play-all"></use></svg></a>
<a href="javascript:void(0)" class="com-pl-all" data-titles=1039059,1040312,1039465,1038478,1037797,1039585><svg class="plall-svg"><use xlink:href="/img/vects.v2.svg#pl-all"></use></svg></a>
</div>
<a href="/dj-top-10s" class="com-see-all grid-mn-itm"><svg class="see-all-svg"><use xlink:href="/img/vects.v2.svg#see-all"></use></svg></a>
</div>
<div class="grid-cont">

<div class="grid-page">
<div class="grid-item play-ttl ptl-1039059" data-tid="1039059">
<div class="grid-image">
<a href=""><img src="https://spinstatz.net/img/michez.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">DJ Michez</a>
Belgrade
<div>Serbia</div>
</div>
</div><div class="grid-item play-ttl ptl-1040312" data-tid="1040312">
<div class="grid-image">
<a href=""><img src="https://spinstatz.net/img/nonice.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">DJ Nothin Nice</a>
Winter Park
<div>Florida</div>
</div>
</div><div class="grid-item play-ttl ptl-1039465" data-tid="1039465">
<div class="grid-image">
<a href=""><img src="https://spinstatz.net/img/ko.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">DJ KO</a>
Fort Collins
<div>Colorado</div>
</div>
</div><div class="grid-item play-ttl ptl-1038478" data-tid="1038478">
<div class="grid-image">
<a href=""><img src="https://spinstatz.net/img/blaq.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">DJ Blaq Mozart</a>
Lawrenceville
<div>Georgia</div>
</div>
</div>
</div>
</div>


</div>
<div class="grid-footer"> </div>

<input type="hidden" id="tabClusterAlt" value="1039059,1040312,1039465,1038478,1037797,1039585" />
</div><div class="front-tab-grid com-grid six v- init-invis">
<div class="grid-hdr">
<a href="javascript:void(0)" class="menu-btn">
<svg class="menu-svg grid">
<use xlink:href="/img/vects.v2.svg#menu"></use>
</svg>
</a>
<div class="compact-mn-cont"></div>
<a href="" class="name-hdr ellip">WHAT'S HOT</a>


</div>
<div class="grid-cont">

<div class="grid-page">
<div class="grid-item play-ttl ptl-1031434" data-tid="1031434">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/268"><img src="https://spinstatz.net/artwork/1527104234DA828FAF-280C-429A-97B1-A66337EBDA31.jpeg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">$200K</a>
DB Kash
<div><a href="" class="com-label">Dirty Boy Records</a></div>
</div>
</div><div class="grid-item play-ttl ptl-1027579" data-tid="1027579">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/641"><img src="https://spinstatz.net/artwork/1538415992Who%20They%20Want.jpg"/></a>

</div>
<div class="links ellip">
<a href="" class="com-title">Who They Want</a>
KenSoul
<div><a href="" class="com-label">NLA Productions</a></div>
</div>
</div><div class="grid-item play-ttl ptl-1025749" data-tid="1025749">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/616"><img src="https://spinstatz.net/artwork/1537650138Lil%20Donald%20-%20Do%20Better.jpeg" /></a>

</div>
<div class="links ellip">
<a href="/title/1025749/lost-without-u-extended" class="com-title">Do Better</a>
LiL Donald
<div><a href="/label/30259/glitterbox-recordings" class="com-label">Kuhnsinity Records</a></div>
</div>
</div><div class="grid-item play-ttl ptl-1026559" data-tid="1026559">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/605"><img src="https://spinstatz.net/artwork/1537241424HELLO%20.PNG" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">Hello</a>
Donna Adja
<div><a href="" class="com-label">D.Adja Productions</a></div>
</div>
</div>
</div>
<div class="grid-cont">

<div class="grid-page"><br><br>
<div class="grid-item play-ttl ptl-1031434" data-tid="1031434">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/631"><img src="https://spinstatz.net/artwork/1537993206Big%20Booty.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">Big Booty</a>
Devontaii
<div><a href="" class="com-label">Dollyhood Records</a></div>
</div>
</div><div class="grid-item play-ttl ptl-1027579" data-tid="1027579">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/594"><img src="https://spinstatz.net/artwork/1536642445image.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">Diddy</a>
AkinG Kalld Pedro
<div><a href="../../s" class="com-label">DC Top 20</a></div>
</div>
</div><div class="grid-item play-ttl ptl-1025749" data-tid="1025749">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/582"><img src="https://spinstatz.net/artwork/1536429480my%20alias%20back%20cover.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">My Alias (Extended)</a>
Georgia Boys
<div><a href="" class="com-label">It's I Love Music</a></div>
</div>
</div><div class="grid-item play-ttl ptl-1026559" data-tid="1026559">
<div class="grid-image">
<a href="https://spinstatz.net/dj/campaign/95"><img src="https://spinstatz.net/artwork/1522703224GOALSCOVER.jpg" /></a>

</div>
<div class="links ellip">
<a href="" class="com-title">Goals</a>
Mike Kelly
<div><a href="" class="com-label">CrestisMuzik</a></div>
</div>
</div>
</div>
</div>

</body>
</html>