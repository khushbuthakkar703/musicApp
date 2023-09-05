@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <link rel="stylesheet" href="/plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <div class="container-fluid container">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h3>Edit Advertisement</h3>
                        </br>
                    </div>

                </div>

            </div>

            <div class="row">
                @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                    </div>
                @endif
                <form class="form-horizontal" method="POST"
                      action="{{ route('advertisementUpdate',['id'=>$edit->id]) }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @if(isset($error))
                        <div class="alert alert-danger">
                            {{$error}}}
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-3 control-label">Title</label>

                        <div class="col-md-6">
                            <input type="text" name="title" id="title" value="{{$edit->title}}" class="form-control"/>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="start_date" class="col-md-3 control-label">Start Date</label>

                        <div class="col-md-6">
                            <input type="text" name="start_date" autocomplete="off" id="start_date" value="{{$edit->start_date}}" class="form-control"/>

                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label for="start_date" class="col-md-3 control-label">End Date</label>

                        <div class="col-md-6">
                            <input type="text" name="end_date" id="end_date" value="{{$edit->end_date}}"
                                   class="form-control" autocomplete="off"/>

                            @if ($errors->has('end_date'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Total days :</label>
                        
                        <div class="col-md-6">
                            <label class="control-label" id="totalDays_form">{{$edit->total_days}}</label>
                        </div>                          
                    </div>

                    <div class="form-group">
                    <label class="col-md-3 control-label">Checked any one type</label>

                        <div class="radio-inline">
                          <label>
                           <input type="radio" name="contenttypecheckone1" id="up_img" value="img"  @if((Session::get('adv_edit_form')['contenttypecheckone1'] == 'img')) checked @endif>Upload Image
                          </label>
                        </div>

                        <div class="radio-inline">
                            <label>
                               <input type="radio" name="contenttypecheckone1" id="up_video" value="video" {{(Session::has('adv_edit_form')) ? '':'checked' }}  @if((Session::get('adv_edit_form')['contenttypecheckone1'] == 'video')) checked @endif >
                            Upload video
                          </label>
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}" id="upload_img_div" style="display:none;">
                        <label for="image" class="col-md-3 control-label">Upload the Image</label>

                        <div class="col-md-6">
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control input-lg"
                                   onchange="loadFile(event)" name="image">

                            @if ($errors->has('image'))
                                <span class="text-danger">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                            @endif
                            <img id="imgprev" src="{{'/'.$edit->image}}" style="padding-top: 10px;display: block"
                                 alt="your image" width="100" height="100"
                                 class="{{ is_null($edit->image)?'hidden':'' }}"/>

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('video_url') ? ' has-error' : '' }}"  id="video_url_div" style="display: block;">
                        <label for="video_url" class="col-md-3 control-label">Video Url</label>

                        <div class="col-md-6">
                            <input type="text" name="video_url" id="video_url" value="{{$edit->video_url}}"
                                   class="form-control"/>

                            @if ($errors->has('video_url'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('video_url') }}</strong>
                                        </span>
                            @endif

                        </div>
                    </div>

                     <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}"  >
                        <label for="image" class="col-md-3 control-label">Select Status</label>


                        <div class="col-md-6">
                      
                            @if ($errors->has('status'))
                                <span class="text-danger">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                            @endif

                            <select name="status" class="form-control input-lg">
                                <option value="APPROVE" @if($edit->status == 'APPROVE') selected @endif >Approve</option>
                                <option value="PENDING" @if($edit->status == 'PENDING') selected @endif>Pending</option>
                                <option value="HOLD" @if($edit->status == 'HOLD') selected @endif>Hold</option>
                                <option value="CANCEL" @if($edit->status == 'CANCEL') selected @endif>Cancel</option>
                            </select>   

                        </div>
                    </div>

                    <input type="hidden" name="per_day_amount" id="per_day_amount"
                           value="{{ isset($perDaysCharge)?$perDaysCharge->value:1 }}"/>
                    <input type="hidden" name="total_days" id="totalDays" value="{{ Session::get('adv_edit_form')['total_days'] }}"/>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" value="Save"
                                   class="btn btn-transparent btn-lg btn-transparent-primary btn-block"
                                   onclick="displayAnimation()">
                            <div class="progress hidden" id="progressBarAds" style="height: fit-content">
                                <div class='progress progress-striped active'>
                                    <div class='progress-bar progress-bar-color' id='bar' role='progressbar'
                                         style='width: 100%'>
                                        Uploading
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <script src="/js/bootstrap.min.js"></script>
        <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="/js/moment.min.js"></script>
        <script>
            function displayAnimation() {
                $("#progressBarAds").removeClass('hidden');
            }


            var loadFile = function (event) {
                var output = document.getElementById('imgprev');
                output.src = URL.createObjectURL(event.target.files[0]);
                $('#imgprev').removeClass('hidden');
            };


            $(function () {
                $("#start_date").datepicker({
                    startDate: new Date(),
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                }).on('change', function (selected) {

                    var minDate = new Date( $(this).val());
                    $('#end_date').trigger('change');
                });

                $("#end_date").datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd',
                }).on('change', function (selected) {
                  
                    var maxDate = new Date( $(this).val());
                    
                    var start = $('#start_date').val();
                    start = moment(start);
                    var end = moment($('#end_date').val()).add(1, 'days');
                    var diff = end.diff(start, 'days'); // returns correct number

                    var perDayCharge = $("#per_day_amount").val();
                    var totalPayableAmount = diff * perDayCharge;

                    $('#totalDays').val(diff);

                    $('#totalDays_form').html(diff);

                    fnCalculateAmount(totalPayableAmount);
                });   
                $('#end_date').trigger('change');
            });

            function fnCalculateAmount(amount) {

                var fixedPer = 4.4;
                var transactionFee = ((amount * fixedPer) / 100).toFixed(0);
                var totalAmount = amount * 1 + transactionFee * 1;

                $("#transaction_fee").text(transactionFee);
                $("#hdn_transaction_fee").val(transactionFee);

                $("#showAmount").text(amount);
                $("#totalPayableAmount").text(totalAmount);
                $("#hndAmount").val(amount);
            }


            $(document).ready(function() {
                $('input[type=radio][name=contenttypecheckone1]').change(function() {
                    if (this.value == 'video') {
                         $('#upload_img_div').hide();
                         $('#video_url_div').show();
                    }
                    else{
                         $('#video_url_div').hide();
                         $('#upload_img_div').show();
                    }
                });

                var session = '<?php echo Session::has('adv_edit_form')?'true':'false' ?>';
                if(session == 'true') {
                    jQuery(document).find('input[type=radio][name=contenttypecheckone1]:checked').trigger('change');    
                }

            });
                
        </script>
    </div>
    {{ Session::forget('adv_edit_form')  }}
@endsection
