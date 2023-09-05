@extends('layouts.campaignapp')

@section('content')
    <div class="container-fluid container">

        @if (session('alert'))
            <div class="row">
                <div class="alert alert-{{session('alertClass')}}">
                    {{ session('alert') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h3>Advertisement List</h3>
                    </br>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>No. of Days</th>
                        <th>Status</th>
                        <th>Post Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($adsLists as $key=>$list)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$list->title}}</td>
                            <td>{{$list->start_date}}</td>
                            <td>{{$list->end_date}}</td>
                            <td>{{$list->total_days}}</td>
                            <td>{{ ucfirst(strtolower($list->status))}}</td>
                            <td>{{date('Y-m-d h:i A',strtotime($list->created_at))}}</td>
                            <td>
                                @if(isset($list->image) && $list->image !=null)
                                    <a onclick="openAdImageView('{{$list->image}}')" style="cursor: pointer"> <i
                                                class="fa fa-image"></i></a>&nbsp;
                                @endif

                                @if(isset($list->video_url) && $list->video_url !=null)

                                    @php
                                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $list->video_url, $match);
                                    @endphp
                                    <a onclick="openAdVideoView('{{$match[1]}}')" style="cursor: pointer"> <i
                                                class="fa fa-video-camera"></i></a>
                                    &nbsp;
                                @endif

                                @if($list->status == App\Advertisement::STATUS_PENDING)
                                    <a href="/advertisement/cancel-status/{{$list->id}}" title="Cancel"
                                       class="text-danger">
                                        <i class="fa fa-times"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         style="margin-top: 80px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Image</h4>
                </div>
                <div class="modal-body">
                    <div id="displayData" class="text-center">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="adVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         style="margin-top: 80px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Video</h4>
                </div>
                <div class="modal-body">
                    <div id="displayVideoData" class="text-center">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>

        function openAdImageView(image) {
            $('#adVideoModal').modal('hide');
            $('#adModal').modal('show');
            $("#displayData").html("<img src=/" + image + " class='img-responsive'>");
        }

        function openAdVideoView(video) {
            $('#adModal').modal('hide');
            $('#adVideoModal').modal({show:true,backdrop: false});
            var url ="https://www.youtube.com/embed/"+video;
            $("#displayVideoData").html("<iframe width='100%' id='vidio_src' height='315' src="+url+"  frameborder='0' allowfullscreen></iframe>");
        }

         $(document).on('click','.close',function() {
            $('#vidio_src').removeAttr("src");
        });

        $(document).on('click','#close_btn',function() {
             $('#vidio_src').removeAttr("src");
        });
    </script>

@endsection
