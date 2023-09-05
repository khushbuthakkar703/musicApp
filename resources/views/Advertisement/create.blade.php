@extends('layouts.campaignapp')

@section('content')
    <link rel="stylesheet" href="/plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container-fluid container">

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h3>Create New Advertisement</h3>
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
            <form class="form-horizontal" method="POST" action="{{ route('advertisement.create') }}"
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
                        <input type="text" name="title" id="title" value="{{ Session::get('advertisement_form')['title'] }}" class="form-control"/>

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
                        <input autocomplete="off" type="text" name="start_date" value="{{ Session::get('advertisement_form')['start_date'] }}" id="start_date"  class="form-control"/>

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
                        <input autocomplete="off" type="text" name="end_date" id="end_date" value="{{ Session::get('advertisement_form')['end_date'] }}" class="form-control"/>

                        @if ($errors->has('end_date'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                        @endif

                    </div>
                </div> 


               <div class="form-group">
                    <label class="col-md-3 control-label">Checked any one type</label>

                <div class="radio-inline">
                  <label>
                    <input type="radio" name="contenttypecheckone" value="img" @if ((Session::get('advertisement_form')['contenttypecheckone'] == 'img')) checked="checked" @endif>Upload Image
                  </label>
                </div>

                <div class="radio-inline">
                    <label>
                       <input type="radio" value="video" name="contenttypecheckone" id="up_video" {{(Session::has('advertisement_form')) ? '':'checked' }}  @if ((Session::get('advertisement_form')['contenttypecheckone'] == 'video')) checked="checked" @endif>
                    Upload video
                  </label>
                </div>
                </div>
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}" id="upload_img_div" style="display: none;">
                    <label for="image" class="col-md-3 control-label">Upload the Image</label>

                    <div class="col-md-6">
                        <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control input-lg" id="upload_img"  value=""
                               onchange="loadFile(event)" name="image">
                        @if ($errors->has('image'))
                            <span class="text-danger">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                        @endif
                        <img id="imgprev"  style="padding-top: 10px;display: block" alt="your image" width="100" height="100"
                             class="hidden"/>

                    </div>
                </div>

                <div class="form-group{{ $errors->has('video_url') ? ' has-error' : '' }}" id="video_url_div" style="display: block;">
                    <label for="video_url" class="col-md-3 control-label">Video Url</label>

                    <div class="col-md-6">
                        <input type="text" value="{{ Session::get('advertisement_form')['video_url'] }}" name="video_url" id="video_url" class="form-control"/>

                        @if ($errors->has('video_url'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('video_url') }}</strong>
                                        </span>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    <label for="video_url" class="col-md-3 control-label">Amount</label>

                    <div class="col-md-6">
                        <div class="" style="margin-left: 10px;margin-top: 5px">
                            $ <span id="showAmount">{{ (Session::get('advertisement_form')['amount'] != '') ? Session::get('advertisement_form')['amount'] : 0 }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="video_url" class="col-md-3 control-label">Transaction Amount</label>

                    <div class="col-md-6">
                        <div class="" style="margin-left: 10px;margin-top: 0">
                            $ <span id="transaction_fee">{{ (Session::get('advertisement_form')['transaction_fee'] != '') ? Session::get('advertisement_form')['transaction_fee'] : 0 }}</span>

                            <input type="hidden" id="hdn_transaction_fee" name="transaction_fee" value="{{ Session::get('advertisement_form')['transaction_fee'] }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="video_url" class="col-md-3 control-label">Total Payable Amount</label>

                    <div class="col-md-6">
                        <div class="" style="margin-left: 10px;">
                            $ <span id="totalPayableAmount">{{ (Session::get('advertisement_form')['per_day_amount'] != '') ? Session::get('advertisement_form')['per_day_amount'] : 0 }}</span>
                        </div>
                        <input type="hidden" name="amount" id="hndAmount" value="{{ Session::get('advertisement_form')['amount'] }}"/>
                        <input type="hidden" name="per_day_amount" id="per_day_amount"
                               value="{{ isset($perDaysCharge)?$perDaysCharge->value:1 }}"/>
                        <input type="hidden" name="total_days" id="totalDays" value="{{ (Session::get('advertisement_form')['total_days'] == '' ) ? '0' :'' }}"/>
                    </div>
                </div>

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
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#end_date').datepicker('setStartDate', minDate);
            });

            $("#end_date").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            }).on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#start_date').datepicker('setEndDate', maxDate);

                //var start123 = new Date($('#start_date').datepicker('getEndDate').valueOf());
                var start = $('#end_date').datepicker('getStartDate');
                start = moment(start);
                var end = moment(selected.date).add(2, 'days');
                var diff = end.diff(start, 'days'); // returns correct number

                var perDayCharge = $("#per_day_amount").val();
                var totalPayableAmount = diff * perDayCharge;

                $('#totalDays').val(diff);

                fnCalculateAmount(totalPayableAmount);
            });

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
            $('#video_url_div').hide();
            $('#upload_img_div').show();

            $('input[type=radio][name=contenttypecheckone]').change(function() {
                if (this.value == 'video') {
                     $('#upload_img_div').hide();
                     $('#video_url_div').show();
                }else{
                     $('#video_url_div').hide();
                     $('#upload_img_div').show();
                }
            });

            var session= '<?php echo Session::has('advertisement_form')?'true':'false'; ?>';
            if(session == 'true') {
                jQuery(document).find('input[type=radio][name=contenttypecheckone]:checked').trigger('change');    
            }else{
                jQuery(document).find('input[type=radio][name=contenttypecheckone]:checked').trigger('change');  
            }

        });

    </script>

{{ Session::forget('advertisement_form')  }}

@endsection
