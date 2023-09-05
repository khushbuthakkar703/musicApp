<?php

namespace App\Http\Controllers;


use App\Helpers\PushNotification;
use App\User;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Advertisement;
use App\AdvertisementPayment;
use App\Setting;
use Illuminate\Support\Facades\DB;
use App\Helpers\notification_app;


class AdvertisementController extends Controller
{

    const STATUS_PENDING = "PENDING";
    const STATUS_APPROVE = "APPROVE";
    const STATUS_CANCEL = "CANCEL";
    const STATUS_HOLD = "HOLD";
    const STATUS_UNHOLD = "UNHOLD";

    private $_api_context;

    /**
     * AdvertisementController constructor.
     */
    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perDaysCharge = Setting::where('field', 'per_day_charge')->first();
        return view('Advertisement.create', compact('perDaysCharge'));
    }


    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $input = $request->all();

        $this->validate(request(), [
//            'audio' => 'required|mimes:mp3,m4a,wav',
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required_without:video_url|max:2048',
            'video_url' => 'required_without:image',
        ]);

        Session::put('advertisement_form', $request->all());

        //
        if (isset($input['video_url']) && $input['video_url'] != null) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $input['video_url'], $match);

            if (!isset($match[1])) {
                return redirect()->back()->withError('Invalid Youtube URL');
            }
        }


        $checkAlreadyExist = Advertisement::where(function ($q) use ($input) {
           $q->where(function ($q) use ($input) {
                $q->whereBetween('start_date', [$input['start_date'],   $input['end_date']])
                    ->orwhereBetween('end_date', [$input['start_date'],$input['end_date']]);
            });
        })->where('user_id', Auth::id())
            ->where('status', '<>', self::STATUS_CANCEL)
            ->count();

        if ($checkAlreadyExist > 0) {
            $message = 'In this date not available';
            return redirect()->back()->with('error', $message);
        }

       //For Approve
        $approveAlreadyExist = Advertisement::where(function ($q) use ($input) {
            $q->where(function ($q) use ($input) {
                $q->whereBetween('start_date', [$input['start_date'],   $input['end_date']])
                    ->orwhereBetween('end_date', [$input['start_date'],$input['end_date']]);
            });
        })->where('status', self::STATUS_APPROVE)
          ->count();

        if ($approveAlreadyExist > 0) {
            $message = 'Some ads running on this date';
            return redirect()->back()->with('error', $message);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = request('image');

            $imageName = time() . $file->getClientOriginalName();
            $dir = 'popUpImage';
            $message = $file->move($dir, $imageName);
            $imagePath = $dir . '/' . $imageName;
        }


        $createInput = [
            'user_id' => Auth::id(),
            'title' => $input['title'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'image' => $imagePath,
            'video_url' => $input['video_url'],
            'status' => self::STATUS_PENDING,
            'per_day_amount' => $input['per_day_amount'],
            'transaction_fee' => $input['transaction_fee'],
            'total_days' => $input['total_days']
        ];
	
        // change 8-4-18
        $receiver_id=DB::table('users')
                          ->select('users.id')
                          ->where('users.role','admin')->first();
       
        $notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;



        $user=Auth::user();
        if ($user->token != null) {
            $responseObj = [
                'userId' => $user,
                'receiverId' => $receiver_id->id,
                'source'=>'advertisement_created'

            ];

            $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/advertisement/new/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Advertisement</p><p>Advertisement has been created successfully</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

            $data=['user_id' =>Auth::id(), 'reference_id' =>$receiver_id->id,'subject' =>'Advertisement','message'=>'Advertisement has been created successfully','href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),  
                            ];

            \App\Helpers\Notification::send(2,$data,$message);

        }

        $uerr=User::find($receiver_id->id);


        if ($uerr->token != null) {
            $responseObj = [
                'userId' => $user->id,
                'receiverId' => $uerr->id,
                'source'=>'advertisement_created'

            ];

            $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/advertisement/new/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Advertisement</p><p>Advertisement has been created successfully</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

            $data=['user_id' =>Auth::id(), 'reference_id' => $receiver_id->id,
             'subject' => $message_array['adveritesement']['subject'],'message' => $message_array['adveritesement']['message'],
             'href'   => '','seen' => 0,
             'is_shown' => 0, 'type' => 'admin',
             "created_at" => date('Y-m-d H:i:s'), 
             "updated_at" => date('Y-m-d H:i:s'),  
            ];

            \App\Helpers\Notification::send(2,$data,$message);
        }

		
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
        $redirect_urls->setReturnUrl(url('/advertisement/paypal/status'))
            ->setCancelUrl(url('/advertisement/paypal/status'));

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
            return redirect('/advertisement/paypal/status');
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('ads_data', $createInput);


        if (isset($redirect_url)) {
            // redirect to paypal
            return redirect($redirect_url);
        }


        Session::flash('alert', 'Unknown error occurred');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/advertisement/paypal/status');


        if(redirect()->route('advertisement.list')) {
            Advertisement::create($createInput);
            $request->session()->forget('advertisement_form');
            return redirect()->route('advertisement.list')->with(['alert' => 'Advertisement successfully created', 'alert_class' => 'success']);
        }
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

    /**
     *
     */
    public function advertiseList()
    {
        $userId = Auth::id();
        $adsLists = Advertisement::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('Advertisement.list', compact('adsLists'));

    }


    /**
     * @param $id
     */
    public function cancelStatus($id)
    {

        $userId = Auth::id();
        $adsLists = Advertisement::where('user_id', $userId)
            ->find($id);

        $adsLists->status = self::STATUS_CANCEL;
        $adsLists->save();

        return redirect()->route('advertisement.list')
            ->with(['alert' => 'Advertisement successfully cancel', 'alertClass' => 'success']);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminSideList()
    {

        $adsLists = Advertisement::orderBy('updated_at', 'desc')
            ->get();

        return view('admin.Advertisement.list', compact('adsLists'));
    }


    /**
     * @param $id
     */
    public function statusUpdate($id, $status)
    {


        $userId = Auth::id();
        $adsLists = Advertisement::find($id);

        if (!$adsLists) {
            return redirect()->route('advertisementList')
                ->with(['alert' => "Oops! data not found.", 'alert_class' => 'danger']);
        }

        if ($status == self::STATUS_APPROVE) {
            $input = $adsLists;
            $checkAlreadyExist = Advertisement::where(function ($q) use ($input) {
                $q->where(function ($q) use ($input) {
                    $q->where('start_date', '>=', $input['start_date'])
                        ->where('start_date', '<', $input['end_date']);
                })->orWhere(function ($q) use ($input) {
                    $q->where('start_date', '<=', $input['start_date'])
                        ->where('end_date', '>', $input['end_date']);
                })->orWhere(function ($q) use ($input) {
                    $q->where('end_date', '>', $input['start_date'])
                        ->where('end_date', '<=', $input['end_date']);
                })->orWhere(function ($q) use ($input) {
                    $q->where('start_date', '>=', $input['start_date'])
                        ->where('end_date', '<=', $input['end_date']);
                });
            })
                ->where('status', self::STATUS_APPROVE)
                ->count();

            if ($checkAlreadyExist) {
                return redirect()->route('advertisementList')
                    ->with(['alert' => "Oops! Other ads approve on this date.", 'alert_class' => 'danger']);
            }
        }
		
		//Aprove Notification
		$notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;
        
        if($adsLists->status != 'APPROVE') {
            $user=Auth::user();
            $adId=User::find( $adsLists->user_id);
            if($adId!= null) {
                if ($user->token != null) {
                    $responseObj = [
                        'userId' => $user->id,
                        'adUserId' => $adsLists->user_id,
                        'source'=>'advertisement_request'

                    ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/advertisementStatusUpdate" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Advertisement Request</p><p>Advertisement request by user having email has been approved</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    $data=['user_id' =>Auth::id(), 'reference_id' =>$adsLists->user_id,'subject' => $message_array['adveritesement_approve']['subject'],'message'=> $message_array['adveritesement_approve']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),  
                    ];

                    \App\Helpers\Notification::send(2,$data,$message);

                }


                if ($adId->token != null) {
                    $responseObj = [
                        'userId' => $user->id,
                        'adUserId' => $adsLists->user_id,
                        'source'=>'advertisement_request_approved'

                    ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/advertisementStatusUpdate" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Advertisement Request</p><p>Advertisement request by user having email has been approved</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    $data=['user_id' =>Auth::id(), 'reference_id' =>$adsLists->user_id,'subject' => $message_array['adveritesement_approve']['subject'],'message'=> $message_array['adveritesement_approve']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),  
                    ];

                    \App\Helpers\Notification::send(2,$data,$message);

                }

            }
        } else {


            $user=Auth::user();
            $adId=User::find( $adsLists->user_id);
            if($adId!= null) {
                if ($user->token != null) {
                    $responseObj = [
                        'userId' => $user->id,
                        'adUserId' => $adsLists->user_id,
                        'source'=>'advertisement_request_rejected'

                    ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/advertisementStatusUpdate" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Advertisement Request</p><p>Advertisement request by user having email has been rejected</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    $data=['user_id' =>Auth::id(), 'reference_id' =>$adsLists->user_id,'subject' => $message_array['adveritesement_denied']['subject'],'message'=> $message_array['adveritesement_denied']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),  
                    ];

                    \App\Helpers\Notification::send(2,$data,$message);

                }


                if ($adId->token != null) {
                    $responseObj = [
                        'userId' => $user->id,
                        'adUserId' => $adsLists->user_id,
                        'source'=>'advertisement_request_rejected'

                    ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/advertisementStatusUpdate" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Advertisement Request</p><p>Advertisement request by user having email has been rejected</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    $data=['user_id' =>Auth::id(), 'reference_id' =>$adsLists->user_id,'subject' => $message_array['adveritesement_denied']['subject'],'message'=> $message_array['adveritesement_denied']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),  
                    ];

                    \App\Helpers\Notification::send(2,$data,$message);


                }

            }
        }
        
  
        $adsLists->status = $status;
        $adsLists->save();

        $message = "Status successfully updated";
        return redirect()->route('advertisementList')
            ->with(['alert' => $message, 'alert_class' => 'success']);
    }

    /**
     * Public function desable popup
     */
    public function closeAdsToday()
    {
        $time = strtotime('today 23:59');
        setcookie('disableAdPopUp', true, $time, "/");
    }

    /**
     * Function used date convert
     * @param $input
     * @return int|static
     */
    public function createDate($input)
    {

        $dt = Carbon::parse($input['date']);

        if (isset($input['start']) && $input['start'] == true) {
            $dt = $dt->startOfDay();
        }

        if (isset($input['end']) && $input['end'] == true) {
            $dt = $dt->startOfDay();
        }

        $dt = $dt->timestamp;

        return $dt;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreate()
    {

        $perDaysCharge = Setting::where('field', 'per_day_charge')->first();
        return view('admin.Advertisement.create', compact('perDaysCharge'));
    }

    /**
     * Function used to create new ads admin side
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminStore(Request $request)
    {

        $input = $request->all();

        $this->validate(request(), [
//            'audio' => 'required|mimes:mp3,m4a,wav',
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required_without:video_url|max:2048',
            'video_url' => 'required_without:image',
        ]);

        Session::put('admin_adv_insert', $request->all());

        //
        if (isset($input['video_url']) && $input['video_url'] != null) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $input['video_url'], $match);

            if (!isset($match[1])) {
                return redirect()->back()->withError('Invalid Youtube URL');
            }
        }


        //For Approve
        $approveAlreadyExist = Advertisement::where(function ($q) use ($input) {
           $q->where(function ($q) use ($input) {
                $q->whereBetween('start_date', [$input['start_date'],   $input['end_date']])
                    ->orwhereBetween('end_date', [$input['start_date'],$input['end_date']]);
            });
        })
            ->where('status', self::STATUS_APPROVE)
            ->count();

        if ($approveAlreadyExist > 0) {
            $message = 'Some ads running on this date';
            return redirect()->back()->with('error', $message);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = request('image');

            $imageName = time() . $file->getClientOriginalName();
            $dir = 'popUpImage';
            $message = $file->move($dir, $imageName);
            $imagePath = $dir . '/' . $imageName;
        }


        $createInput = [
            'user_id' => Auth::id(),
            'title' => $input['title'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'image' => $imagePath,
            'video_url' => $input['video_url'],
            'status' => self::STATUS_APPROVE,
            'per_day_amount' => 0,
            'transaction_fee' => 0,
            'total_days' => $input['total_days']
        ];
        Advertisement::create($createInput);

        return redirect()->route('advertisementList')->with(['alert' => 'Advertisement successfully created', 'alert_class' => 'success']);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEdit($id)
    {

        $edit = Advertisement::find($id);

        if (!$edit) {
            return redirect()->route('advertisementList')
                ->with(['alert' => 'Oops data not found!', 'alert_class' => 'danger']);
        }

        $perDaysCharge = Setting::where('field', 'per_day_charge')->first();
        return view('admin.Advertisement.edit', compact('perDaysCharge', 'edit'));
    }


    /**
     * Function used to create new ads admin side
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminUpdate(Request $request, $id)
    {

        $input = $request->all();

        Session::put('adv_edit_form', $request->all());

        $this->validate(request(), [
//            'audio' => 'required|mimes:mp3,m4a,wav',
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|max:2048',
        ]);


        //
        if (isset($input['video_url']) && $input['video_url'] != null) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $input['video_url'], $match);

            if (!isset($match[1])) {
                return redirect()->back()->withError('Invalid Youtube URL');
            }
        }

        $ads = Advertisement::find($id);

        if (!$ads) {
            return redirect()->route('advertisementList')
                ->with(['alert' => 'Oops data not found!', 'alert_class' => 'danger']);
        }


        //For Approve
        $approveAlreadyExist = Advertisement::where(function ($q) use ($input) {
            $q->where(function ($q) use ($input) {
                $q->whereBetween('start_date', [$input['start_date'], $input['end_date']])
                    ->orwhereBetween('end_date', [$input['start_date'],$input['end_date']]);
            });
        })
            ->where('id', '<>', $id)
            ->where('status', self::STATUS_APPROVE)
            ->count();

        if ($approveAlreadyExist > 0) {
            $message = 'Some ads running on this date';
            return redirect()->back()->with('error', $message);
        }

        if ($request->hasFile('image')) {
            $file = request('image');

            $imageName = time() . $file->getClientOriginalName();
            $dir = 'popUpImage';
            $message = $file->move($dir, $imageName);
            $imagePath = $dir . '/' . $imageName;
        }


        $createInput = [
            'title' => $input['title'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'video_url' => $input['video_url'],
            'status' => $input['status']
        ];

        /* if (isset($input['per_day_amount']) && !empty($input['per_day_amount'])) {
             $createInput['per_day_amount'] = $input['per_day_amount'];
         }
         if (isset($input['transaction_fee']) && !empty($input['transaction_fee'])) {
             $createInput['transaction_fee'] = $input['transaction_fee'];
         }*/

        if (isset($imagePath)) {
            $createInput['image'] = $imagePath;
        }
        if (isset($input['total_days']) && !empty($input['total_days'])) {
            $createInput['total_days'] = $input['total_days'];
        }


        Advertisement::where('id', $id)->update($createInput);

        return redirect()->route('advertisementList')
            ->with(['alert' => 'Advertisement successfully updated', 'alert_class' => 'success']);
    }


}
