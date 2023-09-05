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
    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
            id="paymentSuccessModal" style="margin-top:100px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: inherit;" onclick="closeModal()">
                        <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        @if($is_success == true)
                            <span><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                            <span  class="payment-success">Payment Successful</span>
                        @else
                            <span><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                            <span  class="payment-success">Payment Failed</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-content {
            width: 421px;
            border-radius: 10px;
            background: #060606;
            left: 90px;
        }
        .fa-check-circle-o {
            font-size: 100px;
            color: #93E5E5;
            margin: auto;
            display: table;
            font-weight: 100;
        }
        .fa-times-circle-o {
            font-size: 100px;
            color: #FA3131;
            margin: auto;
            display: table;
            font-weight: 100;
        }
        .payment-success {
            text-align: center;
            display: block;
            font-weight: 500;
            font-size: 20px;
            line-height: 30px;
            padding-top: 20px;
            padding-bottom: 20px;
        }
    </style>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#paymentSuccessModal').modal('show');
        });

        function closeModal() {
            window.location.href= '/campaign/dashboard';
        }
    </script>
    <script src="/js/notification.js"></script>

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
    <div class="fb-customerchat" page_id="582913385432510"></div>

</body>
</html>
