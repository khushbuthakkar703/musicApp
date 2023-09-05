<?php

namespace App\Http\Middleware;

use App\Helpers\PushNotification;
use Closure;
use Auth;
use App\MusicCampaign;
use App\MusicCampaignAudio;
use View;
use App\Setting;
use DB;
use App\Helpers\notification_app;
use App\User;

class campaign
{

    protected $campaignDashboard = 'campaign/dashboard';

    protected $exceptUrl = [
        '/user/campaign/edit'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            if (Auth::user()->role === 'campaign') {
                $balanceShare = [];
				$setting = Setting::get()->last();
                $musicCampaign = MusicCampaign::where('user_id', Auth::Id())->first();
                $balanceShare['balance'] = isset($musicCampaign->campaign_balance) ? $musicCampaign->campaign_balance : 0;

                if (!isset($musicCampaign->campaign_balance) ||
                    (isset($musicCampaign->campaign_balance) && $musicCampaign->campaign_balance <= 0)
                ) {
                    $user=Auth::user();

                    /* Low Balance Notification */
					$receiver_id=DB::table('users')
                          ->select('users.id')
                          ->where('users.role','admin')->first();

                    $uerr=User::find($receiver_id->id);
                    if ($uerr->token != null) {
                        $responseObj = [
                            'userId' => $user->id,
                            'campaignId'=> $musicCampaign->id,
                            'source'=>'campaign_balance_low'
                        ];
                        $message='Campaign Balance for campaign named '.$musicCampaign->campaign_name.' is getting low';

                        PushNotification::sendToAUser($uerr->token,$responseObj,$message);

                    }

                    $notification_arr=array();
                    $notification=new notification_app();
                    $message_array=$notification->adminReceivedMesssages;

                    if ($user->token != null) {
                        $responseObj = [
                            'userId' => $user->id,
                            'campaignId'=> $musicCampaign->id,
                            'source'=>'campaign_balance_low'

                        ];
                        $message='Your campaign Balance is getting low';

                        PushNotification::sendToAUser($user->token,$responseObj,$message);

                    }
                   try {
                       $notification_arr = ['user_id' => $receiver_id->id, 'reference_id' => Auth::id(),
                           'subject' => $message_array['campign_low_balence']['subject'],
                           'message' => $message_array['campign_low_balence']['message'],
                           'href' => '' . $musicCampaign->id, 'seen' => 0,
                           'is_shown' => 0, 'type' => 'admin',
                           "created_at" => date('Y-m-d H:i:s'),
                           "updated_at" => date('Y-m-d H:i:s'),
                       ];
                       $notification->onlynotification($notification_arr);
                        }
                        catch (\Exception $e)
                        {

                        }

                    $balanceShare['is_modal'] = true;
                    if (!$request->is($this->campaignDashboard)) {

                        foreach ($this->exceptUrl as $route) {
                            if ($request->getPathInfo() == $route) {
                                return redirect('campaign/dashboard');
                            }
                        }
                    }

                } elseif (isset($musicCampaign->campaign_balance) && $musicCampaign->campaign_balance > 0 && $musicCampaign->campaign_balance < $setting['value']) {
                    $balanceShare['is_modal'] = true;
                }

                View::share('balanceShare', $balanceShare);

                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
