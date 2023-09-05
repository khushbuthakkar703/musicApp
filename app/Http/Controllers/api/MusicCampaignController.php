<?php

namespace App\Http\Controllers\api;

use App\MusicCampaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class MusicCampaignController extends Controller
{
    //
    public function update(Request $request)
    {
        $token=JWTAuth::getToken();
        $user=JWTAuth::toUser($token);

        $campaign = MusicCampaign::where('id',$request->campaign_id)
                                ->where('user_id',$user->id)->first();

        if ($campaign != null && $campaign->spin_rate == 0) {
            $campaign->spin_rate = $request->spinrate;
            $campaign->save();

            return response()->json(["status"=>"success"],200);
        }

        return response()->json(["status"=>"failed"],200);
    }

}
