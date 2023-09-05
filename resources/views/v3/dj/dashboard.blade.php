@extends('v3.layouts.app')
@section('content')
<title>SpinStatz | Spin Videos</title>
<main class=" mdl-layout__content mdl-color--grey-800 pl-3 mt-n4 custom_post_bade djdashboard-post">
    <div class="sidebar-popup-handler">

    </div>
    <div class="dashboard-message-handler">
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
    </div>
    <div class="hero-background">
        <div class="content">
            <!-- Spinstatz DJ Dashboard Heading -->
            <div class="mdl-grid mb-3">
                <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
                    <h3 style="font-weight: bold;">DJ DASHBOARD</h3>
                    <p style="font-weight: bold; font-size:small; color:grey">View Campaigns and select which to support.</p>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card-deck">

                    <!-- MONEY EARNED CARD -->
                    <div class="card money_earned">
                        <div class="card-body">
                            <div>
                                <p class="card-text mt-2" style="font-size: x-large; font-weight:bold;">MONEY EARNED</p>
                            </div>

                            <div class="mt-4">
                                <h1 class="float-left font-weight-bold" style="color:rgb(132, 255, 255)">${{ isset($dj->points_earned)?$dj->points_earned:0}}</h1>
                                <a style=" background-color: rgb(132, 255, 255);" href="/dj/request/payment" class="btn mt-4 float-right" role="button">Withdraw Money</a>
                                <br><br><!-- <header class="widget-statistic-header">System Explainer Video</header><iframe width="280" height="150" src="https://www.youtube.com/embed/LEdLhAEtnHI?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                            </div>
                        </div>

                    </div>
                    <!-- MONEY EARNED CARD END -->

                    <!-- MONTHLY PERFORMANCE CARD -->
                    <div class="card monthly_performan">

                        <div class="card-body">


                            <div>
                                <p class="card-text mt-2" style="font-size:x-large; font-weight:bold;">MONTHLY PERFORMANCE</p>
                            </div>

                            <div class="mt-4">
                                <div id="mydiv" class="float-left d-flex mt-2 align-items-baseline">
                                    <h1 class="mb-2 font-weight-bold" style="color:rgb(132, 255, 255);">{{$lm}}</h1>
                                    <span style=" font-size: x-small;" class="ml-2">SPINS IN {{$m}}</span>
                                </div>

                                <div id="mydiv1" class="float-right mt-3" style="text-align: center;color:rgb(132, 255, 255);">
                                    <span style="font-weight: bold;">{{$diff}}</span> <br>
                                    <span class="text-muted" style="font-size: small;">spins increase<br> from last year</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MONTHLY PERFORMANCE CARD END -->
                </div>
                <hr style="width: 135%;border-top: 1px solid #6A6A6A;">
            </div>

        </div>
    </div>

    <div id="gen" class="content pt-0 tb-pt-30">
        <!-- Begin Sorting Section ---------------------------------------------------------------------------------------------->
        <div class="mdl-grid">
            <!-- Begin Full Width Column ---------------------------------------------------------------------------------------------->
            <!-- Genre <select>    -->
            <div class="dropdown dropdown-menu-handler">
                <select name="select-genere">
                    <option value="">Select Genre</option>
                    @foreach($genres as $genre)
                    <option value="/dj/dashboard/genres/{{{$genre->music_type}}}">{{$genre->name}}</option>
                    </span>
                    @endforeach
                </select>
                <input id="wid_search" class="wid_search first_serach" type="text" placeholder="Search" aria-label="Search">
            </div>

            <!-- Filtering buttons -->
            <span class="type-filter">
        <div id="active_buttons" class="btn-toolbar sm-mb-0 sm-mt-15">
          <a class="openUrlWithoutLoad" href="/dj/dashboard/bpm">
            <button class="btn btn-lg">
              BPM
            </button>
          </a>
      </span>
            <span class="type-filter">
        <a class="openUrlWithoutLoad" href="/dj/dashboard/rate">
          <button class="btn btn-lg">
            $ / Spin
          </button>
        </a>
      </span>


            <span class="type-filter">
        <a class="openUrlWithoutLoad" href="/dj/dashboard/likes">
          <button class="btn btn-lg ">
            Likes
          </button>
        </a>
      </span>


            <a class="openUrlWithoutLoad" href="/dj/dashboard/total_spin">
                <button class="btn btn-lg btn-lg-lg">
                    Most Played
                </button>
            </a>
            <!-- Search form -->
            <input id="wid_search"  class="wid_search last_search" type="text" placeholder="Search" aria-label="Search">


        </div>
        <!-- End Full Width Column ------------------------------------------------------------------------------------------------>
    </div>
    @if (count($campaigns) > 0)
    <section class="campaigns">
        @include('djdashboard.lay')
    </section>
    @endif
</main>
@endsection