<?php

namespace App\Http\Controllers;


use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Setting;


class SettingController extends Controller
{


    /**
     * AdvertisementController constructor.
     */
    public function __construct()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $setting = Setting::get();

        return view('admin.Setting.list',compact('setting'));
    }


    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $input = $request->all();

        foreach ($input as $key => $value) {

            $exist = Setting::where('field', $key)->first();
            if ($exist) {
                $exist->value = $value;
                $exist->save();
            } else {

                $createInput = [
                    'field' => $key,
                    'value' => $value
                ];
                $exist = Setting::create($createInput);
            }
        }

      return  redirect()->back();
    }


    // Paypal process payment after it is done
    public function getPaymentStatus(Request $request)
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        $adsData = Session::get('ads_data');

        // $transactionFee = Session::get('transaction_fee');

        \Log::info('Payment Id: ');
        \Log::info($payment_id);
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        Session::forget('actual_amount');
        Session::forget('transaction_fee');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::flash('alert', 'Payment failed');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect('/advertisement/new/create');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        \Log::info('Payment Result: ');
        \Log::info($result);

        if ($result->getState() == 'approved') {
            //Add any logic here after payment is success

            Session::flash('alert', 'Advertisement successfully added.');
            Session::flash('alertClass', 'success no-auto-close');
            //Session::flash('alertClass', 'success');
            $data = $result->transactions[0]->amount;

            //$finalAmount = $data->total - $transactionFee;
            $finalAmount = $data->total;

            $ads = Advertisement::create($adsData);

            $p = new AdvertisementPayment();
            $p->advertisement_id = $ads->id;
            $p->transaction_id = $payment_id;
            $p->currency_code = "aa";
            $p->payment_status = isset($result->payer->status) ? $result->payer->status : 'UNVERIFIED';
            $p->amount = $finalAmount;
            $p->per_day_amount = $adsData['per_day_amount'];
            $p->save();

            return redirect('/advertisement/list');
        }

        Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/advertisement/new/create');
    }


    public function backupspinrate(){
        $dollor2count = (int) \App\MusicCampaign::where('spin_rate','2')->count();

        if($dollor2count > 0){
            return redirect()->back()->with('error', "spinrate are already $2 now");
        }
        

        \DB::statement("update music_campaigns set temp_spin_rate = spin_rate");
        return redirect()->back()->with('message', "Spinrate backed up");
    }

    public function restorespinrate(){
        \DB::statement("update music_campaigns set spin_rate = temp_spin_rate");
        return redirect()->back()->with('message', "Spinrate restored");


    }

    public function setspinrate(){
        \DB::statement("update music_campaigns set spin_rate = '2' where spin_rate != '0'");   
        return redirect()->back()->with('message', "Spinrate set successful");

    }
}
