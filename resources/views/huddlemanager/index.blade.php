@extends('v2.layouts.layout')
@section('content')
    <title>SpinStatz | Huddle</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="margin-top-0">Huddle Dashboard</h4>
{{--          <span class="margin-top-0">--}}
{{--            <h4 class="margin-top-0"></h4>--}}
{{--            Music Campaigns <small>View campaigns and select which to support.</small></span></div>--}}

        </div>
        <div class="row">

            <div class="pull-right widget_search">
                   <label>Search:</label>
                   <span id="search_loader" style="color: #fff;"></span>
                   <input type="text" name="widget_search" id="wid_search">
            </div>

        </div>
        <style type="text/css">
                .dataTables_filter label {
                    color: #fff;
                }

                .dataTables_length select, input {
                    background-color: #3a4144;
                    /*border: 0.2px solid #fff;*/
                    padding: 3px;
                }

                .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                    padding: 3px !important;
                }
                .widget_search {
                    margin-top: 35px;
                    position: relative;
                    margin-right: 12px;
                }
                #search_loader {
                    position: absolute;
                    right: 5px;
                    top: 6px;
                    font-size: 17px;
                 }
            </style>
        <style>
            .type-filter {
                padding-right: 0px;
                padding-left: 0px;
            }
        </style>
        <div>

            @if (count($campaigns) > 0)
                <section class="campaigns">
                    @include('huddlemanager.musics')
                </section>

            @endif

        </div>
    </div>
    <script type="text/javascript">
       // document.getElementsByClassName("dashboard")[0].classList.add('active');
    </script>

    @include('CommonComponents.adPopUp')

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/jquery.ellipsis.min.js"></script>

<script type="text/javascript">



function play(a)
{
   audio = $(a).find('audio')[0];

   var toggle_class=$(a).attr('class');
   $(a).toggleClass("fa-pause");
   if(toggle_class=="fa fa-play music-btn")
   {
      // audio.pause();
      audio.play();
   }
   else
   {

      audio.pause();
      audio.currentTime = 0;
   }
}



    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();


         $('#wid_search').on('input', function() {
        var searchKeyword = $(this).val();
            if (searchKeyword.length >= 2) {
                $('#search_loader').addClass('fa fa-spinner fa-spin');
                $.ajax({
                type: 'get',
                url:'/huddle',
                data:{searchKeyword:searchKeyword},
                success:function(res) {
                       $('.campaigns').html(res);
                       $('#search_loader').removeClass('fa fa-spinner fa-spin');
                    }
                });
            } else if( searchKeyword.length == 0) {
                $('#search_loader').addClass('fa fa-spinner fa-spin');
                $.ajax({
                type: 'get',
                url:'/huddle',
                data:{searchKeyword:searchKeyword},
                success:function(res) {
                       $('.campaigns').html(res);
                       $('#search_loader').removeClass('fa fa-spinner fa-spin');
                    }
                });
            }
        });

    });
</script>
<style type="text/css">
.music-btn
{
position: absolute;
    color: #fff;
    left: 32px;
    top: 21px;
    font-size: 3em !important;
}
</style>
