<?php

namespace App\Http\Controllers;
use Auth;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Notification;
use DB;
use App\Http\Controllers\Controller;
use function Sodium\add;

class NotificationController extends Controller
{
    //
    public function index() {

    }

    public function admin_notification() {
    	$user = Auth::user();
		$name=$user->username;
    	$notifications=DB::table('notifications')->join('users', 'users.id', '=', 'notifications.user_id')->where('reference_id',$user->id)->paginate(10);
    	$notificationsList=[];
    	foreach($notifications as $notication)
        {

            if(true)
            {
                $subject=$notication->subject;
                $targetId=$notication->href;
                $type=$notication->type;
                $newhref='';
                $hasTarget=false;
                if($targetId)
                {
                    if($targetId!='#')
                    {
                        $hasTarget=true;
                    }
                }
                if($subject=='New Music Uploaded')
                {
                    if($hasTarget) {
                        $newhref = '/dj/campaign/' . ($targetId);
                    }
                    else{
                        $newhref='/dj/accepted/campaign';
                    }
                }
                elseif($subject=='Campaingn low balance')
                {

                    if ($hasTarget) {
                        if ($type == 'admin') {
                            $newhref = '/campaign/';
                        } elseif ($type == 'approved') {
                            $newhref = '/view/campaign/' . ($targetId);
                        } elseif ($type == 'completed') {
                            $newhref = '/view/campaign/' . ($targetId);
                        } elseif ($type == 'Pending') {
                            $newhref = '/view/campaign/' . ($targetId);
                        }
                    }
                    else{

                          if ($type == 'admin') {
                              $newhref = '/campaign/';
                          } elseif ($type == 'approved') {
                              $newhref = '/djmanager/campaigns';
                          } elseif ($type == 'completed') {
                              $newhref = '/djmanager/campaigns';
                          } elseif ($type == 'Pending') {
                              $newhref = '/djmanager/campaigns';
                          }
                    }

                }
                elseif($subject=='Music Evennt')
                {

                }
                elseif($subject=='Dj Withdraw')
                {
                    $newhref='/admin/request/payments';


                }
                elseif($subject=='Campign add')
                {
                    if($user->role=='admin')
                    {
                        $newhref='/campaign';
                    }
                    elseif ($user->role=='admin')
                    {
                        $newhref='/campaign/list';
                    }

                }

                elseif($subject=='denied')
                {

                    $newhref='/advertisementList';

                }

                $notication->href=$newhref;
            }
            array_push($notificationsList,$notication);


        }

        return view('admin.notification.notification-list',compact('$notificationsList','name'));
    }

    public function dj_notification() {
    	$user = Auth::user();
		$name=$user->username;
    	$notifications=DB::table('notifications')->join('users', 'users.id', '=', 'notifications.user_id')->where('reference_id',$user->id)->paginate(10);
        $notificationsList=[];
        foreach($notifications as $notication)
        {
            $hasHref=false;
            $href=$notication->href;
            if($href)
            {
                if(strlen($href)>5)
                {
                    $hasHref=true;
                }
            }
            if(!$hasHref)
            {
                $subject=$notication->subject;
                $reference_id=$notication->reference_id;
                $type=$notication->type;
                $newhref='';
                if($subject=='New Music Uploaded')
                {
                    $newhref='/dj/campaign/'.($reference_id);
                }
                elseif($subject=='Campaingn low balance')
                {
                    if($type=='admin')
                    {
                        $newhref='/campaign/';
                    }
                    elseif ($type=='approved')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }
                    elseif ($type=='completed')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }
                    elseif ($type=='Pending')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }

                }
                elseif($subject=='Music Evennt')
                {

                }
                elseif($subject=='Dj Withdraw')
                {
                    $newhref='/admin/request/payments';


                }
                elseif($subject=='Campign add')
                {
                    if($user->role=='admin')
                    {
                        $newhref='/campaign';
                    }
                    elseif ($user->role=='admin')
                    {
                        $newhref='/campaign/list';
                    }

                }

                elseif($subject=='denied')
                {

                    $newhref='/advertisementList';

                }

                $notication->href=$newhref;

            }
            array_push($notificationsList,$notication);


        }
        return view('dj.notification',compact('notificationsList','name'));
    }

    public function djmanager_notification() {
    	$user = Auth::user();
		$name=$user->username;
    	$notifications=DB::table('notifications')->join('users', 'users.id', '=', 'notifications.user_id')->where('reference_id',$user->id)->paginate(10);
        $notificationsList=[];
        foreach($notifications as $notication)
        {
            $hasHref=false;
            $href=$notication->href;
            if($href)
            {
                if(strlen($href)>5)
                {
                    $hasHref=true;
                }
            }
            if(!$hasHref)
            {
                $subject=$notication->subject;
                $reference_id=$notication->reference_id;
                $type=$notication->type;
                $newhref='';
                if($subject=='New Music Uploaded')
                {
                    $newhref='/dj/campaign/'.($reference_id);
                }
                elseif($subject=='Campaingn low balance')
                {
                    if($type=='admin')
                    {
                        $newhref='/campaign/';
                    }
                    elseif ($type=='approved')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }
                    elseif ($type=='completed')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }
                    elseif ($type=='Pending')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }

                }
                elseif($subject=='Music Evennt')
                {

                }
                elseif($subject=='Dj Withdraw')
                {
                    $newhref='/admin/request/payments';


                }
                elseif($subject=='Campign add')
                {
                    if($user->role=='admin')
                    {
                        $newhref='/campaign';
                    }
                    elseif ($user->role=='admin')
                    {
                        $newhref='/campaign/list';
                    }

                }

                elseif($subject=='denied')
                {

                    $newhref='/advertisementList';

                }

                $notication->href=$newhref;

            }
            array_push($notificationsList,$notication);


        }
        return view('DjManager.notification',compact('notificationsList','name'));
    }

    public function campaign_notification() {
    	$user = Auth::user();
		$name=$user->username;
    	$notifications=DB::table('notifications')->join('users', 'users.id', '=', 'notifications.user_id')->where('reference_id',$user->id)->paginate(10);
        $notificationsList=[];
        foreach($notifications as $notication)
        {
            $hasHref=false;
            $href=$notication->href;
            if($href)
            {
                if(strlen($href)>5)
                {
                    $hasHref=true;
                }
            }
            if(!$hasHref)
            {
                $subject=$notication->subject;
                $reference_id=$notication->reference_id;
                $type=$notication->type;
                $newhref='';
                if($subject=='New Music Uploaded')
                {
                    $newhref='/dj/campaign/'.($reference_id);
                }
                elseif($subject=='Campaingn low balance')
                {
                    if($type=='admin')
                    {
                        $newhref='/campaign/';
                    }
                    elseif ($type=='approved')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }
                    elseif ($type=='completed')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }
                    elseif ($type=='Pending')
                    {
                        $newhref='/view/campaign/'.($reference_id);
                    }

                }
                elseif($subject=='Music Evennt')
                {

                }
                elseif($subject=='Dj Withdraw')
                {
                    $newhref='/admin/request/payments';


                }
                elseif($subject=='Campign add')
                {
                    if($user->role=='admin')
                    {
                        $newhref='/campaign';
                    }
                    elseif ($user->role=='admin')
                    {
                        $newhref='/campaign/list';
                    }

                }

                elseif($subject=='denied')
                {

                    $newhref='/advertisementList';

                }

                $notication->href=$newhref;

            }
            array_push($notificationsList,$notication);


        }
        return view('campaign.notification',compact('notificationsList','name'));
    }
}
