<?php

namespace App\Http\Controllers;

use App\AdditionalCampaignMusic;
use App\Helpers\PushNotification;
use Illuminate\Http\Request;
use App\Helpers\PusherData;
use App\Notification;
use File;
use DB;
use Auth;
use App\User;
use App\MusicCampaign;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Mail;
use Session;
use App\Helpers\notification_app;
use Tymon\JWTAuth\Facades\JWTAuth;

class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $music = MusicCampaign::where('campaign_balance','=',0)->groupBy('user_id')->get();
        //p($music);

        foreach ($music as $value) {
                        
                            $id_artist = $value['user_id'];
                            $message=[
                  
                                'html'=>'<li><a class="dropdown-menu-notifications-item" href="/cron/artist_low_balance" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campaingn low balance</p><p>Campaingn balance is low.</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                            ];
                           // dd($message);
                            PusherData::sendNotification($id_artist , $message);

                        }

        
    }


}
?>