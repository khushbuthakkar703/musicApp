@extends('layouts.campaignapp')
<title>Spinstatz | Addons</title>
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

    <div class="hero-background-user" style="position: relative;  min-height: 290px;   background-size: cover !important; background-position: center center !important;')" >
        <div class="content">
            <!-- Spinstatz DJ Dashboard Heading -->
            <div class="mdl-grid mb-3">
                <div class="mdl-cell mdl-cell--12-col mdl-color-text--grey-50">
                    <h3 id="user-dashboard ml-unset">Addons</h3>
                    <!-- <p style="font-weight: bold; font-size:small; color:grey">This provides an overview of your music campaign</p> -->
                    <div id="heading" class="mb-4 ml-unset mt-50">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content pt-0">
        <div id="cards-pad" class="row">
            @for ($i = 0; $i < 4; $i++)
            <div class="card-deck mt-4 col-4 total_spins">
                <!-- MONEY EARNED CARD -->
                <div class="card height-160">

                    <div class="card-body m-3">
                        <div>
                            <p class="card-text mt-2" style="font-size: x-large; color:white ">Filter DJ</p>
                        </div>
                        <div class="mt-35">
                            <div id="mydiv" class="float-left align-items-baseline">
                                <form method="post" action="{{route('campaign.addons.save')}}">
                                @if(false)
                                    <input type="hidden" name="filter-user" value="0">
                                    <input type="submit" class="btn-primary" value="Enable"/>
                                @else
                                    <input type="hidden" name="filter-user" value="1">
                                    <input type="submit" class="btn-danger" value="Disable"/>
                                @endif
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endfor
        </div>
    </div>
@endsection