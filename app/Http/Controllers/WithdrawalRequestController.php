<?php

namespace App\Http\Controllers;

use App\Helpers\Notification;
use App\Helpers\PushNotification;
use App\Helpers\PusherData;
use App\IdentifiedMusic;
use App\WithdrawalRequest;
use Illuminate\Http\Request;
use App\Dj;
use App\User;
use App\Advertiser;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Helpers\notification_app;

class WithdrawalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wrs = WithdrawalRequest::join('djs','withdrawal_requests.dj_id','djs.id')
                    ->where('withdrawal_requests.status',"requested")
                    ->where('role','dj')
                    ->select('withdrawal_requests.id','status','first_name','last_name','dj_name','points_earned','request_amount','total_spin')
                    ->get();
        //return $wrs;
                  // dd($wrs);
        $wrs_advertiser = WithdrawalRequest::join('advertisers','withdrawal_requests.dj_id','advertisers.id')
                    ->where('withdrawal_requests.status',"requested")
                    ->select('withdrawal_requests.id','status','name','points_earned','request_amount','paypal_email')
                    ->where('role','advertiser')
                    ->get();
        //return $wrs_advertiser;
        return view('payment.request',compact('wrs', 'wrs_advertiser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WithdrawalRequest  $withdrawalRequest
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawalRequest $withdrawalRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WithdrawalRequest  $withdrawalRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawalRequest $withdrawalRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WithdrawalRequest  $withdrawalRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WithdrawalRequest  $withdrawalRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawalRequest $withdrawalRequest)
    {
        //
    }


    public function requestPayment(){
        $api = false;
        if( request()->is('api/*')){
            $api = true;
            $token=JWTAuth::getToken();
        }

        if($api){
            $currentUser = JWTAuth::toUser($token);;
        }else{
            $currentUser = auth()->user();
        }

        if($currentUser->role == 'dj'){
            $user = Dj::where('user_id',$currentUser->id)->first();
        }else if($currentUser->role == 'manager'){
            $user = Dj_Manager::where('user_id',$currentUser->id)->first();
        }else if($currentUser->role == 'campaign'){
            //$user = Dj::where('user_id',$currentUser->id)->first();
        }else if($currentUser->role == 'advertiser'){
            $user = Advertiser::where('user_id',$currentUser->id)->first();
        }



        if($user->paypal_email == null){
            if($api){
                return response()->json(array('message'=>'Goto update profile and set paypal email'),201);
            }else{
                return redirect()->back()->withError('Goto update profile and set paypal email');
            }
        }

        $wCount = WithdrawalRequest::where('dj_id',$user->id) //no in users table but user's table
                        ->where('status','requested')
                        ->where('role',$currentUser->role)
                        ->count();

        if($wCount>0){
            if($api){
                return response()->json(array('message'=>'Payment Already Requested'),201);
            }else{
                return redirect()->back()->withError('Payment Already Requested');
            }

        }else if($currentUser->blocked == 'yes' ){
            if($api){
                return response()->json(array('message'=>'Your Payment is blocked'),201);
            }else{
                return redirect()->back()->withError('Your Payment is blocked');
            }

        }else if($user->points_earned < 100){
            if($api){
                return response()->json(array('message'=>'You do not have sufficient balance(100)'),201);
            }else{
                return redirect()->back()->withError('You do not have sufficient balance(100)');
            }

        }else{
            $wr = new WithdrawalRequest();
            $wr->dj_id = $user->id;
            $wr->request_amount = $user->points_earned;
            $wr->role = $currentUser->role;
            $wr->status = 'requested';

            /* Request Notification */
            $receiver_id=DB::table('users')
                          ->select('users.id')
                          ->where('users.role','admin')->first();



            $uerr=User::find($receiver_id->id);

            Notification::publishMessage(
                "api",
                "payment_withdrawl_requested",
                ["push","email"],
                $user->id,
                "payment_withdrawl_requested",
                "",
                "/img/user-1-profile.jpg",
                array("type"=> "payment_withdrawl_requested"),
                array("to"=>$uerr->email,"message"=>"A dj has requested payment")
            );

            $wr->save();

            if($currentUser->role == "dj"){
                IdentifiedMusic::where('dj_id',$currentUser->id)
                    ->where('paid', 1)
                    ->where('payments_records->status', IdentifiedMusic::no_action)
                    ->update(['payments_records->status'=> IdentifiedMusic::accepted, 'payments_records->wr_id'=> $wr->id]);
            }

            if($api){
                return response()->json(array('message'=>'Payment Successfully Requested'),200);
            }else{
                return redirect()->back()->withMessage('Payment Successfully Requested');
            }

        }
    }


    public function decline(WithdrawalRequest $wr){

     // require '../vendor/autoload.php';
        //dd($wr->dj_id);
        $wr->status = 'declined';
        $wr->save();

        /* Payment Declined Notification */
        $receiver_id=DB::table('users')
                          ->select('users.id')
                          ->where('users.role','admin')->first();
                          //dd($receiver_id);

		$notification_arr=array();
		$notification=new notification_app();
		$message_array=$notification->adminReceivedMesssages;

        $dj = Dj::find($wr->dj_id);
        $uerr=User::find($dj->user_id);
        //dd($uerr);

        if($uerr!=null) {
            if ($uerr->token != null) {

                $responseObj = [
                    'userId' => $uerr->id,
                    'source'=>'payment_rejected'

//                    'manager' => $manager->id
                ];
                $user_Id = $responseObj['userId'];
             //   dd($user_Id);
              //  $message = "DJ payment request rejected";
                //dd($message);
                $message=[

                  'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/request/payments" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Dj Withdraw</p><p>Dj Withdraw Money Denied</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                ];

                $data=['user_id' =>Auth::id(), 'reference_id' => $uerr->id,'subject' => $message_array['dj_withdraw_denied']['subject'],'message'=> $message_array['dj_withdraw_denied']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                ];

                \App\Helpers\Notification::send(2,$data,$message);

            }
        }

        Notification::publishMessage(
            "api",
            "payment_withdrawl_denied",
            ["push"],
            $wr->dj_id,
            "payment_withdrawl_denied",
            "",
            "/img/user-1-profile.jpg",
            array("type"=> "payment_withdrawl_denied")
        );

        return redirect('/admin/request/payments')->withMessage('Payment Requested Denied');
    }

}
