<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\User;
use App\Helpers\PusherData;
use App\Notification;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;
use App\Deposit;
use Session;
use App\WithdrawalRequest;

use App\IdentifiedMusic;
use Carbon\Carbon;
use App\MusicCampaignAudio;
use App\MusicCampaign;
use App\Dj;
use App\Advertiser;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\notification_app;
use Cors;

class PaypalController extends Controller
{

    private $_api_context;

    public function init($region){

    }

    public function __construct()
    {
        // setup PayPal api context
        $payer_region = "global";
        $paypal_conf = config('paypal');
        if($payer_region == "europe"){
            $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['eu_client_id'], $paypal_conf['eu_secret']));
        }else{
            $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        }

        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    // show paypal form view
    public function showForm(Request $request)
    {
        $user = Auth::user();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        }else{
            $campaign = $user->musicCampaign()->first();
        }



        $campaign_audio = $campaign->musicCampaignAudio()->first();
        if($campaign_audio != NULL && $campaign_audio->genre != NULL && strtolower($campaign_audio->genre) != 'null') {
             if ( in_array(13, json_decode($campaign_audio->genre)) || in_array(6, json_decode($campaign_audio->genre))) {
                $show100 = true;
            } else {
                $show100 = false;
            }
        } else {
            $show100 = false;
        }
        $region = $campaign->getRegion();
        return view('payment.paypal', compact('show100', "region"));
    }

    public function showForm_formobile(Request $request, MusicCampaign $campaign)
    {
        /*$user = UserHelper::get_current_user();
        if($campaign->user_id != $user->id){
            return response()->json(['message'=>'wrong_id']);
        }*/
        $campaign_audio = $campaign->musicCampaignAudio()->first();

        if($campaign_audio != NULL) {
            if ( in_array(13, json_decode($campaign_audio->genre)) || in_array(6, json_decode($campaign_audio->genre))) {
                $show100 = true;
            } else {
                $show100 = false;
            }
        } else {
            $show100 = false;
        }
        $region = $campaign->getRegion();
        $mc_id = $campaign->id;
        return view('payment.paypal_mobile', compact('show100', "region", "mc_id"));
    }

    //Controller for users to do payment
    public function store(Request $request)
    {
        if($request->input('campaign_name') != '') {
            $userId = Auth::id();

            $campaign = new MusicCampaign();
            $firstCampaign = $campaign->where('user_id', $userId)->first();
            
            $firstCampaign->campaign_name = $request->input('campaign_name');
            unset($firstCampaign->id);
            $newCampaign = $campaign->create($firstCampaign->toArray());
            $newCampaign->target_country = '[]';
            $newCampaign->target_state = '[]';
            $newCampaign->target_city = '[]';
            $newCampaign->target_colition = '[]';
            //$newCampaign->is_flag = 1;
            $newCampaign->save();

            $campaign_id = $newCampaign->id;
            Session::put('new_campaign_id', $campaign_id);
            Session::put('is_flag', $request->input('is_flag'));
            Session::put('company_name', $request->input('company_name'));
            Session::put('artist_website', $request->input('artist_website'));
            Session::put('song_title', $request->input('song_title'));
            Session::put('release_date', $request->input('release_date'));
            Session::put('isrc', $request->input('isrc'));
            Session::put('upc', $request->input('upc'));
            Session::put('musictype', $request->input('musictype'));
            Session::put('artist_name', $request->input('artist_name'));
            $image = $request->file('image');
            $name = time() . $image->getClientOriginalExtension();
            $destinationPath = public_path('/artwork/');
            $image->move($destinationPath, $name);
            $imageDest = $destinationPath.$name;
            $imagePath = $name;
            Session::put('image', $imagePath);

            $file = $request->file('audio');
            $fileExt = $file->getClientOriginalExtension();
            if (!in_array($fileExt, ["mp3","MP3"])) {
                return redirect()->back()->with('audio.error', 'The audio must be a file of type: mp3, MP3.');
            }
            $audioName = time() . str_replace(" ","", $request->input('song_title'));
            $message = $file->move('audio', $audioName.'.'.$fileExt);
            $audioPath=public_path().'/audio/'.$audioName.'.'.$fileExt;
            $audioPathNew=public_path().'/audio/spin'.$audioName.'.'.$fileExt;
            Session::put('audio', $audioName);
            Session::put('audioPath', $audioPath);
        }

        \Log::info('Intiating Payment');
        $this->init("global");

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        \Log::info('Payment Amount: ');
        \Log::info($request->input('amount'));
        $item = new Item();
        $item->setName('Amount to Add')// item name
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->input('amount')); // unit price

        
        // add item to list
        $item_list = new ItemList();
        $item_list->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->input('amount'));
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Amount to Add');

        $redirect_urls = new RedirectUrls();
        // Specify return & cancel URL
        $redirect_urls->setReturnUrl(url('/payment/paypal/status'))
            ->setCancelUrl(url('/payment/paypal/status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
       try {
            $payment->create($this->_api_context);
            
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            Session::flash('alert', 'Something Went wrong, funds could not be loaded');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect('/payment/paypal/status');
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('actual_amount', $request->input('actual_amount'));
        Session::put('transaction_fee', $request->input('transaction_fee'));

        if (isset($redirect_url)) {
            // redirect to paypal
            if($request->input('is_flag') == '1') {
                return response()->json($redirect_url);
            }
            else {
                return redirect($redirect_url);
            }
        }


        Session::flash('alert', 'Unknown error occurred');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/payment/paypal/status');
    }


    // Paypal process payment after it is done
    public function getPaymentStatus(Request $request)
    {
        // Get the payment ID before session clear
        $this->init("global");
        $payment_id = Session::get('paypal_payment_id');

        $actualAmount = Session::get('actual_amount');
        $transactionFee = Session::get('transaction_fee');

        \Log::info('Payment Id: ');
        \Log::info($payment_id);
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        Session::forget('actual_amount');
        Session::forget('transaction_fee');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::flash('alert', 'Payment failed');
			Session::flash('status', false);
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect('/payment/paypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        // //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        \Log::info('Payment Result: ');
        \Log::info($result);


        if ($result->getState() == 'approved') {
            //Add any logic here after payment is success
            Session::flash('alert', 'You payment is complete');
			Session::flash('status', true);
            //Session::flash('alertClass', 'success');
            $data = $result->transactions[0]->amount;

            $finalAmount = $data->total - $transactionFee;

            $p = new Deposit();
            $p->campaign_uid = Auth::id();
            $p->transaction_id = $payment_id;
            $p->currency_code = "aa";
            $p->payment_status = isset($result->payer->status) ? $result->payer->status : 'UNVERIFIED';
            $p->amount = $finalAmount;
            $p->save();

            if (Session::has('new_campaign_id')) {
                $campaignId = Session::get('new_campaign_id');
                $campaign = MusicCampaign::find($campaignId);
            } else {
                $campaign = MusicCampaign::where('user_id', $p->campaign_uid)->first();
            }
            if ($finalAmount == 100 && $campaign->campaign_balance < 20) {
                $campaign->spin_rate = '20';
            }

            try {


                $campaignUser = User::find($campaign->user_id);
                $djs = Dj::get();
                //dd($djs);
                if ($campaignUser != null) {
                    if ($campaignUser->token != null) {

                        $data = [];

                        $responseObj = [
                            'userId' => $campaignUser->id,
                            'source'=>'added_money'

                            //'manager' => $manager->id
                        ];

                        foreach ($djs as $key => $value) {


                            $id_dj = $value['user_id'];

                            $data=['user_id' =>Auth::id(), 'reference_id' => $value->user_id,'subject' => 'Campign Music Request','message' =>'Campign Music Request','href'=>'','seen' => 0,'is_shown' => 0, 'type' => 'campaign',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                            ];

                            $message=[

                                'html'=>'<li><a class="dropdown-menu-notifications-item" href="/campaignaudio/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campign Music Request</p><p>Campign Music Request</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                            ];

//                            \App\Helpers\Notification::send(2,$data,$message);


                        }

                    }

                }


            }
            catch (\Exception $e)
            {

            }
            $campaign->campaign_balance += $finalAmount;
            if($campaign->last_deposit == 0.000001){
                $firstPayment = True;
            }else{
                $firstPayment = False;
            }
            $campaign->last_deposit = $finalAmount + $campaign->campaign_balance;

            $referer = $campaign->referid;
            if($referer != null){
                $user = \App\User::find($referer);

                $points_earned = $finalAmount * 5/100;
                if($user->role == 'dj'){
                    $dj = Dj::where('user_id',$referer)->first();
                    $dj->points_earned += $points_earned;
                    $p->referral_amount_paid = $points_earned;
                    $dj->save();

                }else if($user->role == 'campaign'){
                    $campaign = MusicCampaign::where('user_id',$referer)->first();
                    $campaign->campaign_balance += $points_earned;
                    $p->referral_amount_paid = $points_earned;
                    $campaign->save();
                }else if($user->role == 'djmanager'){

                }else if ($user->role == 'advertiser' && $firstPayment && $user->blocked != "yes"){
                    $advertiser = Advertiser::where('user_id',$referer)->first();
                    $points_earned = $finalAmount * $advertiser->reward_percentage/100;

                    if($advertiser->invited_by != null){
                        $advertiser_boss = Advertiser::where('user_id',$advertiser->invited_by)->first();
                        if($advertiser_boss != null){
                            $points_earned_boss_gross = $finalAmount * $advertiser_boss->reward_percentage/100;
                            $points_earned = $points_earned_boss_gross * $advertiser->reward_percentage/100;
                            $points_earned_boss_net = $points_earned_boss_gross - $points_earned;
                            $advertiser_boss->points_earned += $points_earned_boss_net;
                            $advertiser_boss->total_earned += $points_earned_boss_net;
                            $advertiser_boss->save();

                        }
                    }

                    $advertiser->points_earned += $points_earned;
                    $advertiser->total_earned += $points_earned;
                    $p->referral_amount_paid = $points_earned;
                    $p->save();

                    $advertiser->save();
                }

            }

            $campaign->save();
            error_log("--");
            error_log($referer);

            return redirect('/campaign/dashboard');
        }


		Session::flash('status', false);
        Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/payment/paypal');
    }


    //Controller for system to send payments to Dj's
    public function sendPayment(Request $request)
    {
        // Create a new instance of Payout object
        //dd($request);

        //return true; //remove when we start payout
        $wrId = $request->id;
        $wrs = WithdrawalRequest::find($wrId);
        $wrs->payable_amount = IdentifiedMusic::where("payments_records->wr_id", (int)$wrId)
//            ->where('dj_id', (int)$wrs->dj_id)
            ->where("payments_records->status", IdentifiedMusic::accepted)
            ->sum('payments_records->dj_earned_points');
        $wrs->save();

        if ($wrs->status != "requested") {
            return redirect('/admin/request/payments')->withError('Payment Status alredy chenged');
        }

        $wr = $wrs;
        $amount = $wrs->payable_amount;
        if($wr->role == "dj"){
            $withdree = Dj::find($wr->dj_id);
        }else if($wr->role == "advertiser"){
            $withdree = \App\Advertiser::find($wr->dj_id);
        }


        //$email =

        $payouts = new \PayPal\Api\Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("Congratulations You have received a payout from SpinStatz");
        $senderItem = new PayoutItem();
        $payoutAmount = new Currency();
        $payoutAmount->setValue($amount)
            ->setCurrency("USD");

        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for working with us!!!')
            ->setReceiver($withdree->paypal_email)
            ->setSenderItemId($wrId)
            ->setAmount($payoutAmount);

        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);
        // ### Create Payout

        if($withdree->points_earned < $wr->request_amount) {

            return redirect('/admin/request/payments')->withError("Your balance is less then your requested amount, Please request valid amount for withdrawn");
        }
        try {
            $output = $payouts->create(null, $this->_api_context);
            if ($output->getBatchHeader()->getBatchStatus() == 'PENDING' || $output->getBatchHeader()->getBatchStatus() == 'SUCCESS') {
                //Add any logic here after payout is success
                $wr->status = 'success';
                $wr->save();
                $withdree->points_earned = $withdree->points_earned - $amount;
                $withdree->save();

                /* Payment Notification */
                /* $receiver_id=DB::table('users')
                          ->select('users.id')
                          ->where('users.role','admin')->first();*/

                $notification_arr=array();
                $notification=new notification_app();
                $message_array=$notification->adminReceivedMesssages;

                $user=Auth::user();
                if ($user->token != null) {
                    $responseObj = [
                        'userId' => $user->id,
                        'withdrawId' => $withdree->user_id,
                        'source'=>'payment_withdraw'

                    ];

                    $user_Id = $responseObj['userId'];

                    $message = "Payment has completed successfully for DJ  " . $withdree->dj_name;

                    $data=['user_id' =>Auth::id(), 'reference_id' => $withdree->user_id,
                     'subject' => $message_array['dj_withdraw']['subject'],'message' => $message_array['dj_withdraw']['message'],
                     'href'   => '','seen' => 0,
                     'is_shown' => 0, 'type' => 'admin',
                     "created_at" => date('Y-m-d H:i:s'),
                     "updated_at" => date('Y-m-d H:i:s'),
                    ];

                    $message=[

                                'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/request/payments" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Dj Withdraw</p><p>Dj Withdraw Money Accepted</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                            ];

                     \App\Helpers\Notification::send(2,$data,$message);
                }

                \App\Helpers\Notification::publishMessage(
                    "api",
                    "payment_withdrawl_complete",
                    ["push"],
                    $withdree->user_id,
                    "payment_withdrawl_requested",
                    "",
                    "/img/user-1-profile.jpg",
                    array("type"=> "payment_withdrawl_requested")
                );

                return redirect('/admin/request/payments')->withMessage('Payment Successful');
            } else {
                $wr->status = 'unknown';
                $wr->save();
                return redirect('/admin/request/payments')->withError('Payment Status unknown');
            }

        } catch (Exception $ex) {
            Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
            Session::flash('alertClass', 'danger no-auto-close');
            $wr->status = 'corrupted';

            /* Withdrawn Fail Notification */
            $notification_arr=array();
            $notification=new notification_app();
            $message_array=$notification->adminReceivedMesssages;



            $user=Auth::user();
            if ($user->token != null) {
                $responseObj = [
                    'userId' => $user->id,
                    'withdrawId' => $withdree->user_id,
                    'source'=>'payment_failed'

                ];

                $message=[

                  'html'=>'<li><a class="dropdown-menu-notifications-item" href="/payments/paypal/payout" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Payment</p><p>Payment has been failed</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                ];

                $data=['user_id' =>Auth::id(), 'reference_id' => $withdree->user_id,
                 'subject' => $message_array['dj_withdraw_faild']['subject'],'message' => $message_array['dj_withdraw_faild']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'),"updated_at" => date('Y-m-d H:i:s'),
                ];

                Notification::publishMessage(
                    "api",
                    "payment_withdrawl_error",
                    ["push"],
                    Auth::id(),
                    "payment_withdrawl_requested",
                    "",
                    "/img/user-1-profile.jpg",
                    array("type"=> "payment_withdrawl_error")
                );

                \App\Helpers\Notification::send(2,$data,$message);

            }

            $wr->save();
            return redirect('/admin/request/payments')->withError('Payment Status Corrupted');
        }

        return redirect('/payment/paypal/payout');
    }


    public function globalTester()
    {
        //$musicmatch = new IdentifiedMusic();
        //$musicmatch->music_id = 29;
        //$musicmatch->dj_id = 001;
        //$musicmatch->played_timestamp = Carbon::now();
        //$musicmatch->save();
        $userid = 3;
        $songid = 3;
        $count = IdentifiedMusic::where('dj_id', $userid)
            ->where('music_id', $songid)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();
        return $count;

        $campaign_audio = MusicCampaignAudio::find(29);
        $campaign = MusicCampaign::find($campaign_audio->campaign_id);
        $dj = Dj::where('user_id', $userid)->first();
        return $dj;
        //$spin_rate = $campaign->spin_rate;
        if ($campaign->campaign_balance >= $campaign->spin_rate)
            $campaign->campaign_balance = $campaign->campaign_balance - $campaign->spin_rate;

        $campaign->save();
        return $campaign;
    }

        public function manualPayment(WithdrawalRequest $wr){
        $dj = Dj::find($wr->dj_id);
        $wr->status = 'success';
        $wr->save();
        $dj->points_earned = $dj->points_earned - $wr->request_amount;
        $dj->save();

        $notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;

        $user_details = User::find($dj->user_id);

        if($user_details!=null) {
                if ($user_details->token != null) {
                    $responseObj = [
                        'userId' => $user_details->id,
                        'source'=>'dj_payment_request'
//                    'manager' => $manager->id
                    ];

                    $user_Id = $responseObj['userId'];

                    $message = "DJ payment requested ";

                    $data=['user_id' =>Auth::id(), 'reference_id' => $dj->user_id,'subject' => $message_array['dj_withdraw_request']['subject'],'message' => $message_array['dj_withdraw_request']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' =>'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')
                    ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/request/payments" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Dj Withdraw</p><p>Dj Withdraw Money Accepted</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    \App\Helpers\Notification::send(2,$data,$message);

                }
            }

            return redirect()->back()->withMessage('Payment Successful');
    }

    public function store_mobile(Request $request, MusicCampaign $campaign)
    {

        \Log::info('Intiating Payment');
        $this->init("global");

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        \Log::info('Payment Amount: ');
        \Log::info($request->input('amount'));
        $item = new Item();
        $item->setName('Amount to Add')// item name
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->input('amount')); // unit price

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->input('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Amount to Add');

        $redirect_urls = new RedirectUrls();
        // Specify return & cancel URL
        $redirect_urls->setReturnUrl(route('campaignpaymentmobilestatus'))
            ->setCancelUrl(route('campaignpaymentmobilestatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            Session::flash('alert', 'Something Went wrong, funds could not be loaded');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect()->route('campaignpaymentmobilestatus');
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        Session::put('new_campaign_id', $campaign->id);
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('actual_amount', $request->input('actual_amount'));
        Session::put('transaction_fee', $request->input('transaction_fee'));

        if (isset($redirect_url)) {
            // redirect to paypal
            return redirect($redirect_url);
        }


        Session::flash('alert', 'Unknown error occurred');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect()->route('campaignpaymentmobilestatus');
    }

    public function getPaymentStatusMobile(Request $request)
    {
        // Get the payment ID before session clear
        $this->init("global");
        $payment_id = $request->get('paymentId');
        $actualAmount = Session::get('actual_amount');
        $transactionFee = Session::get('transaction_fee');

        \Log::info('Payment Id: ');
        \Log::info($payment_id);
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        Session::forget('actual_amount');
        Session::forget('transaction_fee');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::flash('alert', 'Payment failed');
            Session::flash('status', false);
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect('/payment/paypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        // //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        \Log::info('Payment Result: ');
        \Log::info($result);


        if ($result->getState() == 'approved') {
            //Add any logic here after payment is success
            Session::flash('alert', 'You payment is complete');
            Session::flash('status', true);
            //Session::flash('alertClass', 'success');
            $data = $result->transactions[0]->amount;

            $finalAmount = $data->total - $transactionFee;

            $p = new Deposit();
            $p->campaign_uid = Session::get('new_campaign_id');
            $p->transaction_id = $payment_id;
            $p->currency_code = "aa";
            $p->payment_status = isset($result->payer->status) ? $result->payer->status : 'UNVERIFIED';
            $p->amount = $finalAmount;
            $p->save();

            if (Session::has('new_campaign_id')) {
                $campaignId = Session::get('new_campaign_id');
                $campaign = MusicCampaign::find($campaignId);
            } else {
                $campaign = MusicCampaign::where('user_id', $p->campaign_uid)->first();
            }
            if ($finalAmount == 100 && $campaign->campaign_balance < 20) {
                $campaign->spin_rate = '20';
            }

            try {


                $campaignUser = User::find($campaign->user_id);
                $djs = Dj::get();
                //dd($djs);
                if ($campaignUser != null) {
                    if ($campaignUser->token != null) {

                        $data = [];

                        $responseObj = [
                            'userId' => $campaignUser->id,
                            'source'=>'added_money'

                            //'manager' => $manager->id
                        ];

                        foreach ($djs as $key => $value) {


                            $id_dj = $value['user_id'];

                            $data=['user_id' =>Auth::id(), 'reference_id' => $value->user_id,'subject' => 'Campign Music Request','message' =>'Campign Music Request','href'=>'','seen' => 0,'is_shown' => 0, 'type' => 'campaign',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                            ];

                            $message=[

                                'html'=>'<li><a class="dropdown-menu-notifications-item" href="/campaignaudio/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campign Music Request</p><p>Campign Music Request</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                            ];

                            \App\Helpers\Notification::send(2,$data,$message);


                        }

                    }

                }


            }
            catch (\Exception $e)
            {

            }
            $campaign->campaign_balance += $finalAmount;
            if($campaign->last_deposit == 0.000001){
                $firstPayment = True;
            }else{
                $firstPayment = False;
            }
            $campaign->last_deposit = $finalAmount + $campaign->campaign_balance;

            $referer = $campaign->referid;
            if($referer != null){
                $user = \App\User::find($referer);

                $points_earned = $finalAmount * 5/100;
                if($user->role == 'dj'){
                    $dj = Dj::where('user_id',$referer)->first();
                    $dj->points_earned += $points_earned;
                    $p->referral_amount_paid = $points_earned;
                    $dj->save();

                }else if($user->role == 'campaign'){
                    $campaign = MusicCampaign::where('user_id',$referer)->first();
                    $campaign->campaign_balance += $points_earned;
                    $p->referral_amount_paid = $points_earned;
                    $campaign->save();
                }else if($user->role == 'djmanager'){

                }else if ($user->role == 'advertiser' && $firstPayment && $user->blocked != "yes"){
                    $advertiser = Advertiser::where('user_id',$referer)->first();
                    $points_earned = $finalAmount * $advertiser->reward_percentage/100;

                    if($advertiser->invited_by != null){
                        $advertiser_boss = Advertiser::where('user_id',$advertiser->invited_by)->first();
                        if($advertiser_boss != null){
                            $points_earned_boss_gross = $finalAmount * $advertiser_boss->reward_percentage/100;
                            $points_earned = $points_earned_boss_gross * $advertiser->reward_percentage/100;
                            $points_earned_boss_net = $points_earned_boss_gross - $points_earned;
                            $advertiser_boss->points_earned += $points_earned_boss_net;
                            $advertiser_boss->total_earned += $points_earned_boss_net;
                            $advertiser_boss->save();

                        }
                    }

                    $advertiser->points_earned += $points_earned;
                    $advertiser->total_earned += $points_earned;
                    $p->referral_amount_paid = $points_earned;
                    $p->save();

                    $advertiser->save();
                }

            }

            $campaign->save();
            error_log("--");
            error_log($referer);

            return "success";
        }


        Session::flash('status', false);
        Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/payment/paypal');
    }


}