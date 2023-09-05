<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('jwt', function () {
    return response()->json(['instanceOf' => get_class(auth()->user())]);
})->middleware('auth:api', 'jwt.refresh');
//Route::get('/matchResult','IdentifiedMusicController@matchResult');
Route::get('/login', 'ApiAuthController@login');
Route::post('/createDJAccount', 'ApiAuthController@createDJAccount');

Route::POST('/refresh', 'ApiAuthController@refresh');
Route::post('/login', 'ApiAuthController@login');

Route::post('/match', 'ApiAuthController@match')->middleware('jwt.auth');
Route::get('/match', 'ApiAuthController@testMatch');

Route::post('/videopost', 'ApiAuthController@recordVideoUrl')->middleware('jwt.auth');

Route::get('/clubs', 'ApiAuthController@getClubs')->middleware('jwt.auth');
Route::get('/videos', 'ApiAuthController@getVideos')->middleware('jwt.auth');
Route::get('/getCountries', 'ApiAuthController@getCountries')->middleware('jwt.auth');
Route::get('/getManagers', 'ApiAuthController@getManagers')->middleware('jwt.auth');
Route::post('/getStates', 'ApiAuthController@getStates')->middleware('jwt.auth');
Route::post('/getCities', 'ApiAuthController@getCities')->middleware('jwt.auth');
Route::get('/campaignList', 'ApiAuthController@campaignList')->middleware('jwt.auth');
Route::get('/userCampaigns', 'ApiAuthController@getCampaignsListUser')->middleware('jwt.auth');
Route::get('/campaign/joined/{campaign}/{user}', 'ApiAuthController@isjoined')->middleware('jwt.auth');

Route::get('/campaignDashboard', 'ApiAuthController@campaignDashboard')->middleware('jwt.auth');
Route::post('/saveOneToken', 'ApiAuthController@saveOneToken')->middleware('jwt.auth');
Route::post('/campaignStore', 'ApiAuthController@campaignStore');
Route::post('/newCampaignStoreAPI', 'ApiAuthController@newCampaignStore')->middleware('jwt.auth');
Route::post('/filterTargetAdvanced', 'ApiAuthController@filterTargetAdvanced')->middleware('jwt.auth');
Route::post('/estimationAdvanced', 'ApiAuthController@estimationAdvanced ')->middleware('jwt.auth');

Route::post('/uploadImageCampaignUser', 'ApiAuthController@uploadImage')->middleware('jwt.auth');


Route::post('/storeAdvertisement', 'api\ApiAuthController@storeAdvertisementAPI')->middleware('jwt.auth');
Route::get('/advertiseList', 'ApiAuthController@advertiseList')->middleware('jwt.auth');
Route::post('/invitecampaignAPI', 'ApiAuthController@invitecampaignAPI')->middleware('jwt.auth');


Route::post('/updateCampaignProfile', 'ApiAuthController@updateprofile')->middleware('jwt.auth');
Route::get('/getFilters', 'ApiAuthController@getFilters')->middleware('jwt.auth');
Route::get('/getFiltersNew', 'ApiAuthController@getFiltersNew')->middleware('jwt.auth');
Route::get('/removeFilter', 'ApiAuthController@removeFilter')->middleware('jwt.auth');

Route::post('/get_widget_search', 'ApiAuthController@get_widget_search')->middleware('jwt.auth');

Route::get('/getDjsThisWeekLastWeeks', 'ApiAuthController@getDjsThisWeekLastWeeks')->middleware('jwt.auth');





Route::post('/campaign/updateartwork/{campaign}','MusicCampaignController@updateartwork')->middleware('jwt.auth');
Route::post('/campaign/updateaudio/{campaign}','MusicCampaignController@updateaudio')->middleware('jwt.auth');

Route::get('/campaign/getspintable', 'MusicCampaignController@getSpinTableAPI');
Route::get('/campaign/getSpinTableNew', 'MusicCampaignController@getSpinTableNew');

Route::post('/app_login', 'api\ApiAuthController@login');
Route::get('/dj/campaigns', 'api\ApiAuthController@campaigns')->middleware('jwt.auth');
Route::get('/dj/accept/campaigns', 'api\AcceptedCampaignController@accepted')->middleware('jwt.auth');

Route::get('/dj/campaign/accept/{campaign}', 'api\AcceptedCampaignController@accept')->middleware('jwt.auth');
Route::get('/dj/campaign/leave/{campaign}', 'api\AcceptedCampaignController@leave')->middleware('jwt.auth');

Route::get('/profile/dj', 'api\ApiAuthController@djprofile');
Route::get('/spin/history', 'api\ApiAuthController@spinned')->middleware('jwt.auth');
Route::post('/spin/history', 'api\ApiAuthController@spinned')->middleware('jwt.auth');
Route::get('/notification', 'api\ApiAuthController@getNotification')->middleware('jwt.auth');
Route::get('/notification/delete/{notification}', 'api\ApiAuthController@deletenotification')->middleware('jwt.auth');
Route::get('/notification/deleteAll', 'api\ApiAuthController@deleteAllnotification')->middleware('jwt.auth');
Route::get('/notification/markasread/{notification}', 'api\ApiAuthController@marknotificationasread')->middleware('jwt.auth');
Route::get('/notification/markAllasread', 'api\ApiAuthController@markallnotificationasread')->middleware('jwt.auth');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmailApi');
Route::get('/campaign/{musicCampaign}', 'MusicCampaignController@getcampaignApi');
Route::post('/campaign/updatespinrate', 'api\MusicCampaignController@update');
Route::get('/mycampaign', 'MusicCampaignController@getMyCampaign');
Route::get('/dj/reaction/{campaign}/{reaction}', 'api\ApiAuthController@reaction')->middleware('jwt.auth');
Route::get('/inbox', 'api\ApiAuthController@getChatHistory')->middleware('jwt.auth');
Route::get('/message/get', 'MessageController@getConversation')->middleware('jwt.auth');
Route::get('/messages', 'MessageController@getAllConversation')->middleware('jwt.auth');
Route::post('/message/send', 'MessageController@store')->middleware('jwt.auth');
Route::get('/message/delete/{message}', 'MessageController@deleteMesssage')->middleware('jwt.auth');
Route::get('/message/deleteall/{parther}', 'MessageController@deleteAllMesssage')->middleware('jwt.auth');
Route::get('/message/seen/{sender}', 'MessageController@markasseen')->middleware('jwt.auth');
Route::get('/user_data/{user}','api\ApiAuthController@get_user_table_data')->middleware('jwt.auth');

Route::post('/campaign/create', 'api\ApiAuthController@createcampaignAccount')->middleware('guest');

Route::post('/campaignaudio/create', 'api\ApiAuthController@addMusicToCampaign')->middleware('jwt.auth');
Route::post('/campaign/deposit', 'api\DepositController@addDeposit')->middleware('jwt.auth');

Route::get('/dj/request/payment', 'WithdrawalRequestController@requestPayment')->middleware('jwt.auth');
Route::get('/getgenre','MusicTypeController@getAllApi');
Route::get('/dj/profile/edit', 'DjController@edit')->middleware('jwt.auth');
Route::post('/dj/profile/update/{dj}', 'DjController@update')->middleware('jwt.auth');
Route::post('/dj/profileUpload', 'DjController@uploadImage')->middleware('jwt.auth');
Route::post('/dj/addvenue','DjController@addclubs')->middleware('jwt.auth');
Route::post('/dj/updatevenue/{club}','ClubController@update')->middleware('jwt.auth');
Route::post('/dj/deleteclub/{club}','ClubController@destroy')->middleware('jwt.auth');
Route::post('/updatepassword', 'ApiAuthController@updatePassword')->middleware('jwt.auth');
Route::get('/conversations/{user}', 'MessageController@getMyConversations')->middleware('jwt.auth');
Route::get('/forceupdate', 'VCSController@forceupdate');

Route::get('/city/{city}', function (App\City $city){
    return $city;
});

Route::get('/country/{country}', function (App\Country $country){
    return $country;
});

Route::get('/state/{state}', function (App\State $state){
    return $state;
});

Route::post('/log', function (Request $request){
   \Illuminate\Support\Facades\Log::info("app->".$request->log);
   return "logged";
});

Route::get('/countries', function () {
    return App\Country::all();
});

Route::get('/states/{country}', function ($country) {
    return App\State::where('country_id', $country)->orderBy('name','asc')->get();
});

Route::get('/cities/{state}', function ($state) {
    return App\City::where('state_id', $state)->get();
});

Route::get('/checkonline/{user}', function (\App\User $user) {
    return response()->json(array('online' => $user->isOnline()), 201);
});

Route::get('/geonlinedjs', function () {
    $onlineDjs = array();
    $djs = \App\User::where('role', 'dj')->get();
    foreach ($djs as $user) {
        if ($user->isOnline()) {
            $dj = $user->dj->first();
            $u['id'] = $user->id;
            $u['image'] = $user->profile_picture;
            $u['name'] = $dj->first_name . ' ' . $dj->last_name;
            $onlineDjs[] = $u;
        }
    }

    return response()->json(array('onlinedjs' => $onlineDjs), 201);
});

Route::get('/isonline/{uid}', function ($uid) {
    $user = \App\User::find($uid);


    return response()->json(array('online' => $user->isOnline()), 201);
});

Route::post("pushnotify", function(){
//    return response()->json(['status'=> 'complete']);
    Redis::publish('mychannel', json_encode([
            'source_app_id' => "api",
            'created_at' =>  Carbon::now()->toIso8601String(), #now timestamp
            'type' => request()->type,  #subject for push, email ....
            'destination' => ["push"],
            'user_id'=>request()->user_id,
            'message'=>request()->message,
            'href' => request()->route,

            'reference_id' => request()->user_id,
            'image' => request()->image,
            'one_signal_token'=> request()->token,
            'data'=>request()->data
        ])
    );

    return response()->json(['status'=> 'complete']);
});



Route::prefix('v1')->group(function () {
    Route::middleware(['jwt.auth'])->group(function () {
        Route::post('/artist/complete_profile', 'MusicCampaignController@update_profile');
        Route::post('/campaign/store', 'MusicCampaignController@campaignstorev1');
    });

    Route::middleware(['guest'])->group(function () {
        Route::post('/artist/register', 'Auth\RegisterController@storeregistercampaign');
    });


});