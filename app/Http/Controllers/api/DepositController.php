<?php

namespace App\Http\Controllers\api;

use App\Deposit;
use App\Http\Middleware\campaign;
use App\MusicCampaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PayPal\Rest\ApiContext;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;

class DepositController extends Controller
{
    //
    public function addDeposit1(Request $request){
        $paypal_conf = config('paypal');
        $context =  new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $payment = Payment::get('PAY-5VC84302P1227393XLMMFBQQ', $context);
        $context->setConfig($paypal_conf['settings']);
        return $payment;
//        if($payment->id == $request->payment_id){
//            $p = new Deposit();
//            $p->campaign_uid = $user->id;
//            $p->transaction_id = $payment->id;
//            $p->currency_code = "aa";
//            $p->payment_status = isset($result->payer->status) ? $result->payer->status : 'UNVERIFIED';
//            $p->amount = $finalAmount;
//            $p->save();
//            return $request->json("status","true");
//        }else{
//            return $request->json("status","true");
//        }
    }

    public function addDeposit(Request $request){
        $deposit = new Deposit();



        $deposit->campaign_uid = $request->campaign_uid;
        $deposit->transaction_id = $request->transaction_id;
        $deposit->currency_code = $request->currency_code;
        $deposit->payment_status = $request->payment_status;
        $deposit->amount = $request->amount;
        $deposit->created_at = $request->date;
        $deposit->save();

        $campaign = MusicCampaign::find($request->campaign_id);
        $campaign->campaign_balance += $request->amount;
        $campaign->save();



        return response()->json("success",200);

    }
}
