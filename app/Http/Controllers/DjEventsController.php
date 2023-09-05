<?php

namespace App\Http\Controllers;

use App\DjEvents;
use App\Helpers\PushNotification;
use Illuminate\Http\Request;
use Auth;
use App\Helpers\notification_app;


class DjEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = auth()->user();

        if(isset($request->id)){
            $dj = \App\Dj::find($request->id);
        }else{
            $dj = $user->dj()->first();
        }
        
        
        if($user->role == 'dj'){
            $layout = 'djapp';
        }else{
            $layout = $user->role;
        }

        $djEvents = DjEvents::where('dj_id',$dj->id)->get();

        //return $djEvents;
        
        return view('djevents.index',compact('djEvents','dj','layout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //return $request->all();
        
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
        $request_data = $request->all();
        $dj= \App\Dj::find($request_data['dj_id']);
        $manager = $dj->djmanager()->first();
        $reciptant = $manager->email;
        
        /* Event Notification */
        /* $receiver_id=DB::table('users')
                          ->select('users.id')
                          ->where('users.role','admin')->first();*/

        $notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;
        if($dj!=null) {
            if ($dj->token != null) {
                $responseObj = [
                    'userId' => $dj->id,
                    'manager' => $manager->id,
                    'source'=>'event_created'

                ];

                $message=[

                  'html'=>'<li><a class="dropdown-menu-notifications-item" href="/dj/mobile/events" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Event</p><p>New Event has been created</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                ];

                $data=['user_id' =>Auth::id(), 'reference_id' => $manager->id,'subject' => $message_array['dj_notification']['subject'],'message' => $message_array['dj_notification']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'dj',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                ];

                \App\Helpers\Notification::send(2,$data,$message);

            }
        }
        
        DjEvents::create($request_data);
        
        // Mail::send('email.eventnotification', ['cc' => "test", 'reciptant' => $reciptant], function ($message) use ($reciptant) {
        //         $message->to($reciptant, 'DJ')->subject('SpinStatz Successful Registration!');
        //     });

        return redirect()->back()->withMessage('New Event Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DjEvents  $djEvents
     * @return \Illuminate\Http\Response
     */
    public function show(DjEvents $djEvents)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DjEvents  $djEvents
     * @return \Illuminate\Http\Response
     */
    public function edit(DjEvents $djEvents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DjEvents  $djEvents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DjEvents $djEvents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DjEvents  $djEvents
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return $id;
        $djEvents->delete();
    }

    public function delete(DjEvents $event){
        $user = auth()->user();
        $dj = $event->dj()->first();
        $manager = $dj->djmanager()->first();

        
        if($dj->user_id == $user->id || $manager->id == $user->id){
            $event->delete();
            return redirect()->back()->withMessage('Event Removed');
            
        }

        return redirect()->back()->withError('Access Denied');    

        
    }

    public function updatestatus(DjEvents $id, $status){
        // implement manager check here
        //
        $user = auth()->user();
        if($user->role == 'djmanager'){
            $dj = $id->dj()->first();
                                
            if( $dj->invited_by != $user->id){
                return response()->json(['success' => false], 200);
            }
        }

        $id->status = $status;



        
        /* Event Update status */
        $notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;

        if($dj!=null) {
            if ($dj->token != null) {
                $responseObj = [
                    'userId' => $dj->id,
                    'source'=>'campaign_balance_low'

//                    'manager' => $manager->id
                ];

                 $message=[

                  'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/mobiledj/event/update" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campaign Balance</p><p>Campaign Balance is getting low </p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                ];

                $data=['user_id' =>Auth::id(), 'reference_id' =>$dj->id,'subject' => $message_array['djman_event_status']['subject'],'message' => $message_array['djman_event_status']['message'],'href'   => '','seen'=> 0,'is_shown' => 0, 'type' => $status,"created_at" => date('Y-m-d H:i:s'),"updated_at" => date('Y-m-d H:i:s'), 
                ];

                \App\Helpers\Notification::send(2,$data,$message);

            }
        }



        if($user!=null) {
            if ($user->token != null) {
                $responseObj = [
                    'userId' => $dj->id,
                    'source'=>'campaign_balance_low'

//                    'manager' => $manager->id
                ];

                $message=[

                  'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/mobiledj/event/update" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campaign Balance</p><p>Campaign Balance is getting low</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                ];

                $data=['user_id' =>Auth::id(), 'reference_id' =>$dj->id,'subject' => $message_array['djman_event_status']['subject'],'message' => $message_array['djman_event_status']['message'],'href'   => '','seen' => 0,'is_shown' => 0, 'type' => $status,"created_at" => date('Y-m-d H:i:s'),"updated_at" => date('Y-m-d H:i:s'), 
                ];

                \App\Helpers\Notification::send(2,$data,$message);

            }
        }

        
        $notification_arr=['user_id' =>Auth::id(), 'reference_id' =>$dj->id,
             'subject' => $message_array['djman_event_status']['subject'],'message' => $message_array['djman_event_status']['message'],
             'href'   => '','seen' => 0,
             'is_shown' => 0, 'type' => $status,
             "created_at" => date('Y-m-d H:i:s'), 
             "updated_at" => date('Y-m-d H:i:s'),  
        ];
        $notification->onlynotification($notification_arr);
        
        $id->save();
        return response()->json(['success' => true], 200);

    }
}
