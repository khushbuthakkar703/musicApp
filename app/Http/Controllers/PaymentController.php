<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Deposits;

class DepositController extends Controller {
    public function payment(Request $request){
           $product=Product::find($request->id);    
      return view('payment.paypal',compact('product'));
    }
    public function paymentInfo(Request $request){        
        if($request->tx){
            if($payment=Deposit::where('transaction_id',$request->tx)->first()){
                $payment_id=$payment->id;
            }else{
                $payment=new Deposit;
                $payment->item_number=$request->item_number;
                $payment->transaction_id=$request->tx;
                $payment->currency_code=$request->cc;
                $payment->payment_status=$request->st;
                $payment->save();
                $payment_id=$payment->id;
            }
        return 'Pyament has been done and your payment id is : '.$payment_id;
        
        }else{
            return 'Payment has failed';
        }
    }
}