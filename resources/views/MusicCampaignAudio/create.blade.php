<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- <script src="{!! asset('js/fingerprint.js') !!}"></script> -->
    <script src="/js/jquery-1.12.3.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/typicons.min.css">
    <link rel="stylesheet" href="/css/varello-theme.min.css">
    <link rel="stylesheet" href="/css/varello-skins.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/icheck-all-skins.css">
    <link rel="stylesheet" href="/css/icheck-skins/flat/_all.css">
    <link href='https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600,700,300' rel='stylesheet' type='text/css'>    <link rel="apple-touch-icon" sizes="57x57" href="../apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="../manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>


<body >
<script>
  fbq('track', 'Purchase', {
    value: 1,
    currency: 'USD',
  });
</script>
    <div class="notifications top-right"></div>
    <div class="wrapper">
        <div class="page-wrapper">
          <header class="top-header">
          </header>
            <div class="container">
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
              <title>Add Audio | SpinStatz</title>

    <link rel="stylesheet" href="/plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="page-wrapper">
        <div class="log-in-wrapper"><img src="/img/SpinstatsApplogo.png" width="300" height="145" alt=""/><div>SpinStatz Reserves the right to reject any music that does not meet our quality standards. If your music is rejected you will be issued a full refund and can email info@spinstatz.com for an explanation.</div>
            <form method="POST" action="{{ route('addaudio') }}" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="song_title" value="{{old('song_title')}}"
                           placeholder="Song Title Name">

                    @if ($errors->has('song_title'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('song_title') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="company_name" value="{{old('company_name')}}"
                           placeholder="Name of the company">

                    @if ($errors->has('company_name'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="artist_website"
                           value="{{old('artist_website')}}" placeholder="Enter the artist website">
                    @if ($errors->has('artist_website'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('artist_website') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="text" class="form-control input-lg" value="{{old('release_date')}}"
                           name="release_date" id="date">

                    @if ($errors->has('release_date'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('release_date') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="isrc" value="{{old('isrc')}}" minlength="12"
                           placeholder="Enter ISRC Code">

                    @if ($errors->has('isrc'))
                        <span class="text-danger">
              <strong>ISRC field is minimum 12 characters of the 12 characters the last 7 characters must
                                be numbers</strong>
            </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="upc" value="{{old('upc')}}"
                           placeholder="Enter UPC Code">

                    @if ($errors->has('upc'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('upc') }}</strong>
                                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="artist_name" value="{{old('artist_name')}}"
                           placeholder="Enter the Artist's name">

                    @if ($errors->has('artist_name'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('artist_name') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="image">Upload artwork</label>
                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control input-lg"
                           onchange="loadFile(event)" name="image" required>

                    @if ($errors->has('image'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                    @endif
                    <center><img id="imgprev" style="padding-top: 10px" alt="your image" width="100" height="100"
                                 class="hidden"/>
                    </center>
                </div>


                <div class="form-group">
                    <label for="audio">Upload audio file (10MB MAX MP3 file)</label>
                    <input type="file" class="form-control input-lg" name="audio" required>

                    @if ($errors->has('audio'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('audio') }}</strong>
                                        </span>
                    @endif

                    @if ($flash=session('audio.error'))
                        <span class="text-danger">
                                            <strong>{{$flash }}</strong>
                                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="genre" class="col-md-12">Select the genre (max 2)</label>
                    @for($i=0; $i < count($musictypes); $i++)
                    <div class="col-md-6">
                        <input type="checkbox" name="musictype[]" class="genre-check" data-icheck value="{{$musictypes[$i]->id}}" required>
                        <label for="terms_and_conditions" class="icheck-label">{{$musictypes[$i]->name}}</label>
                    </div>

                    @endfor
                </div>

                    @if ($errors->has('genre'))
                        <span class="text-danger">
                                            <strong>{{ $errors->first('genre') }}</strong>
                                        </span>
                    @endif


                <input type="submit" value="Add Music"
                       class="btn btn-transparent btn-lg btn-transparent-primary btn-block upload-form"
                       onclick="displayAnimation()">
                <input type="submit" value="Cancel"
                       class="btn btn-transparent btn-lg btn-transparent-danger btn-block upload-form"
                       onclick="resetpayment()">
                <div class="progress hidden" id="progressBar" style="height: fit-content">
                    <div class='progress progress-striped active'>
                        <div class='progress-bar progress-bar-color' id='bar' role='progressbar' style='width: 100%'>
                            Uploading
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>


    @if(isset($is_modal) && $is_modal == true)
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
             id="lowBalanceModal" style="margin-top:100px">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
                            Pay
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ route('payment') }}">
                            <small>Please select the amount you would like to deposit to your campaign. You will be able to adjust the amount DJs will earn each time they play your music from your Dashboard once your account is active</small>

                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="amount" class="col-md-4 control-label">Amount</label>
                                <input type="hidden" name="region" value="{{$region}}">
                                <div class="col-md-6">
                                    <select id="amount" type="number" class="form-control"
                                            name="actual_amount"
                                            onchange="fnCalculateAmount(this.value)"
                                            required>
                                        <option value="">Select</option>
                                        <option value="20" {{ $newCampaignSelectedPackage == "demo" ? 'selected':'' }}>$20 (Demo Campaign)</option>
                                        <option value="100" {{ $newCampaignSelectedPackage == "starter" ? 'selected':'' }}>$100 (Starter Campaign)</option>
                                        <option value="500" {{ $newCampaignSelectedPackage == "standard" ? 'selected':'' }}>$500 (Standard Campaign)</option>
{{--                                        <option value="1000">$1000</option>--}}
{{--                                        <option value="2000">$2000</option>--}}
{{--                                        <option value="3000">$3000</option>--}}
                                        <option value="4000" {{ $newCampaignSelectedPackage == "career_boost" ? 'selected':'' }}>$4000 (Career Boost)</option>
{{--                                        <option value="5000">$5000</option>--}}
{{--                                        <option value="7000">$7000</option>--}}
{{--                                        <option value="10000">$10000</option>--}}
                                    </select>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">

                                <label for="amount" class="col-md-4 control-label">Transaction Fee</label>

                                <div class="col-md-6">
                                    <div style="margin-top: 7px;"><span id="transaction_fee">-</span></div>

                                    <input type="hidden" name="transaction_fee" id="hdn_transaction_fee">

                                </div>
                            </div>

                            <div class="form-group">

                                <label for="amount" class="col-md-4 control-label">Total Amount</label>

                                <div class="col-md-6">
                                    <div style="margin-top: 7px;"><span id="total_amount">-</span></div>

                                    <input type="hidden" name="amount" id="hdn_total_amount">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        PAY
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger" onclick="resetpayment()">
                                        Cancel
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    {{--<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>--}}
                </div>
            </div>
        </div>
    @endif

    <script src="/js/bootstrap.min.js"></script>
    <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        function resetpayment(){
            $('#lowBalanceModal').modal('hide');
            window.location = "/current"
        }

        function displayAnimation() {
            $("#progressBar").removeClass('hidden');
        }

        /**
         *
         * @param amount
         */
        function fnCalculateAmount(amount) {

            var fixedPer = 4.4;
            var transactionFee = ((amount * fixedPer) / 100).toFixed(0);
            var totalAmount = amount * 1 + transactionFee * 1;

            $("#transaction_fee").text('$' + transactionFee);
            $("#hdn_transaction_fee").val(transactionFee);

            $("#total_amount").text('$' + totalAmount);
            $("#hdn_total_amount").val(totalAmount);
        }


        var loadFile = function (event) {
            var output = document.getElementById('imgprev');
            output.src = URL.createObjectURL(event.target.files[0]);
            $('#imgprev').removeClass('hidden');
        };

        $(document).ready(function () {
            $('#lowBalanceModal').modal('show');

            $(function(){

                var requiredCheckboxes = $(':checkbox[required]');

                requiredCheckboxes.change(function(){

                    if(requiredCheckboxes.is(':checked')) {
                        requiredCheckboxes.removeAttr('required');
                    }

                    else {
                        requiredCheckboxes.attr('required', 'required');
                    }
                });

            });
        });

         $("#date").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            })

        // $(document).ready(function() {
        //
        //     var progressbar     = $('.progress-bar');
        //
        //     $(".upload-form").click(function(){
        //         $(".form-horizontal").ajaxForm(
        //             {
        //                 beforeSend: function() {
        //                     $(".progress").css("display","block");
        //                     progressbar.width('0%');
        //                     progressbar.text('0%');
        //                 },
        //                 uploadProgress: function (event, position, total, percentComplete) {
        //                     progressbar.width(percentComplete + '%');
        //                     progressbar.text(percentComplete + '%');
        //                 },
        //             });
        //     });
        //
        // });



        $('.genre-check').on('change',function () {
            if($('input[type=checkbox]:checked').length >= 3){
                this.checked = false;
            }
        });

        @if($newCampaignSelectedPackage)
            fnCalculateAmount($("select#amount").val());
        @endif
    </script>
          <script src="/js/notification.js"></script>
</div>
        </div>
        </div>

   <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '1476167555843900',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-customerchat"
  page_id="582913385432510"
>
</div>

</body>
</html>
