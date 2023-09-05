<?php

use App\Events\GenericEvent;

$this->get('/', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
$this->post('/', 'Auth\LoginController@login');
$this->post('/logout', 'Auth\LoginController@logout')->name('logout');
$this->get('/session-dist', function(){
	Session::put('new_campaign_id', null);
});

// Registration Routes...
//$this->get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('/register', 'Auth\RegisterController@register');
Route::get('/dj/signup','Auth\RegisterController@registerdj')->middleware('guest');
Route::post('/dj/signup','Auth\RegisterController@storeregisterdj')->middleware('guest')->name('dj.signup');


// Password Reset Routes...
$this->get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('/password/reset', 'Auth\ResetPasswordController@reset');

$this->get('/logout', 'Auth\LoginController@logout')->name('logout');


//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register/verify/{token}', 'MusicCampaignController@verify');
Route::post('/invite', 'InviteCodeController@invite')->name('invite')->middleware('manadmin');
Route::get('/invite', 'InviteCodeController@index')->name('inviteform')->middleware('manadmin');
Route::get('/reinvite/{invite}', 'InviteCodeController@reInvite')->middleware('manadmin');
Route::get('/invitation/delete/{invite}','InviteCodeController@delete')->middleware('manadmin');
Route::get('/invitedEmail', 'InviteCodeController@invitedEmail')->middleware('manadmin');
Route::get('/invitedEmail/edit', 'InviteCodeController@invitedEmail')->name('editinvitation')->middleware('manadmin');
Route::get('/invitedEmail/delete', 'InviteCodeController@invitedEmail')->name('deleteinvitation')->middleware('manadmin');
Route::get('/invitedEmail/get_dataTable', 'InviteCodeController@get_dataTable')->name('inviteemailDataTable')->middleware('manadmin');
Route::get('/admin/preview/{withdrawlid}', 'AdminController@preview')->name('preview')->middleware('manadmin');
Route::post('/admin/payment_request_action/{status}', 'IdentifiedMusicController@update_payment_status')
    ->name('update_payment_status')->middleware('manadmin');
Route::get('/admin/wavform','MusicCampaignAudioController@generatewavform');

Route::post('/bulkinvite', 'InviteCodeController@bulkinvite')->name('bulkinvite')->middleware('manadmin');
Route::get('/bulkinvite', 'InviteCodeController@bulkindex')->name('bulkindex')->middleware('manadmin');


Route::get('/dj/register', 'DjController@register')->name('djregisterform')->middleware('guest');
Route::post('/dj/register', 'DjController@store')->name('djregister')->middleware('guest');
Route::get('/dj/profile/edit', 'DjController@edit')->name('dj.edit')->middleware('auth');
Route::patch('/dj/profile/update/{dj}', 'DjController@update')->name('dj.update')->middleware('auth');
Route::get('/dj/profile/{id}', 'DjController@index')->name('dj.index');
Route::get('/dj/request/payment','WithdrawalRequestController@requestPayment')->middleware('dj');
Route::post('/dj/profileUpload', 'DjController@uploadImage')->middleware('dj');
Route::get('/dj/spin/videos', 'DjController@getspinnedvioeos')->middleware('dj')->name('djearnedvideos');


Route::get('/dj/campaign/{musicCampaign}', 'MusicCampaignController@show')->middleware('dj');
Route::get('/song/{slug}', 'MusicCampaignController@songprofile');
Route::get('/view/campaign/{musicCampaign}', 'MusicCampaignController@view')->middleware('auth');
Route::get('/widget_search', 'DjDashboardController@get_widget_search')->middleware('auth');

Route::get('/user/campaign/create', 'MusicCampaignController@create');
Route::get('/campaign/create', 'MusicCampaignController@create');
Route::get('/user/test/email', 'MusicCampaignController@test_for_email');
Route::post('/user/campaign/store', 'MusicCampaignController@store');
Route::post('/campaign/dashboard', 'MusicCampaignController@filterTarget');
Route::get('/campaign/filter/advanced','MusicCampaignController@filterAdvanced');
Route::get('/campaign/signup','Auth\RegisterController@registercampaign')->middleware('guest');
Route::post('/campaign/signup','Auth\RegisterController@storeregistercampaign')->middleware('guest')->name('campaign.signup');

Route::post('/campaign/youtube','MusicCampaignAudioController@updateYoutubeEmbaded')->name('campaignaudio.youtube');
Route::post('/campaign/facebook','MusicCampaignAudioController@updatefacebook')->name('campaignaudio.facebook');
Route::post('/campaign/instagram','MusicCampaignAudioController@updateinstagram')->name('campaignaudio.instagram');
Route::post('/campaign/deleteSocialLink','MusicCampaignAudioController@deleteSocialLink');

Route::get('/campaign/dashboard', 'MusicCampaignController@index')->middleware('campaign')->name('campaign.dashboard');
Route::get('/campaign/getspintable','MusicCampaignController@getSpinTable');
Route::get('/campaign/getspintable/api','MusicCampaignController@getSpinTableAPI');
Route::get('/campaign/spinhistory','MusicCampaignController@getSpinHistory');
Route::get('/user/campaign/edit', 'MusicCampaignController@edit')->middleware('campaign');
//Route::get('/campaign/spin/videos', 'MusicCampaignController@spinVideos')->middleware('campaign');
Route::get('/campaign/spin/videosv2', 'MusicCampaignController@spinVideosV2')->middleware('campaign');

Route::get('/campaign/edit/profile', 'MusicCampaignController@editprofile')->middleware('campaign')->name('campaign.edit');
Route::post('/campaign/edit/profile', 'MusicCampaignController@updateprofile')->middleware('campaign');
Route::get('/campaign/update', 'MusicCampaignController@updateprofile')->middleware('campaign');




Route::post('/user/campaign/update', 'MusicCampaignController@update')->middleware('campaign');
Route::post('/campaign/profileUpload', 'MusicCampaignController@uploadImage')->middleware('campaign');
Route::get('/user/campaign/payment', 'MusicCampaignController@userCampaignPaymentStatus');
Route::get('/user/campaign/balance', 'MusicCampaignController@userBalance');


Route::post('/campaign/additionalMusicUpload', 'MusicCampaignController@uploadAdditionalMusic')->middleware('campaign');

// Show payment form
Route::get('/payment/paypal', 'PaypalController@showForm')->name('campaignpayment')->middleware('campaign');
Route::post('/payment/paypal', 'PaypalController@store')->name('payment')->middleware('campaign');
Route::get('/payment/paypal/status', 'PaypalController@getPaymentStatus')->middleware('campaign');
Route::post('/payments/paypal/payout', 'PaypalController@sendPayment')->name('payout')->middleware('admin');
Route::get('/payments/paypal/decline/{wr}', 'WithdrawalRequestController@decline')->middleware('admin');

Route::get('/payment/paypal_mobile/{campaign}', 'PaypalController@showForm_formobile');
Route::post('/payment/paypal_mobile/{campaign}', 'PaypalController@store_mobile')->name('campaignpaymentmobile');
Route::get('/payment/paypal_mobil/status', 'PaypalController@getPaymentStatusMobile')->name('campaignpaymentmobilestatus');

Route::get('/payments/paypal/payout/{key}', function($key){
    if($key == 'ccna'){
        return view('payment.payout');
    }
})->middleware('admin');


Route::get('/dj/dashboard', 'DjDashboardController@index')->middleware('dj');
Route::get('/dj/crate', 'DjDashboardController@crate')->middleware('dj')->name('crate');
Route::get('/dj/dashboard/alphabet', 'DjDashboardController@alphabet')->middleware('dj');
Route::get('/dj/dashboard/rate', 'DjDashboardController@rate')->middleware('auth');
Route::get('/dj/dashboard/bpm', 'DjDashboardController@bpm')->middleware('auth');
Route::get('/dj/dashboard/total_spin', 'DjDashboardController@total_spin')->middleware('auth');
Route::get('/dj/dashboard/genres/{genre}', 'DjDashboardController@genres')->middleware('auth');
Route::get('/dj/dashboard/likes', 'DjDashboardController@like')->middleware('auth');
Route::get('/dj/user/balance', 'DjDashboardController@djUserBalance')->middleware('dj');
Route::post('/dj/reaction','ReactionController@store')->name('djReaction');
// Route::get('/dj/likereaction','ReactionController@store');
Route::get('/dj/inbox/', 'DjDashboardController@inbox')->middleware('dj')->name('dj.inbox');
Route::post('/dj/message/delete', 'DjDashboardController@removeMessage')->name('dj.message.delete')->middleware('dj');
//Routes for genres
Route::get('/genres', 'MusicTypeController@index')->name('genres')->middleware('regionadmin');
Route::get('/genres/create', 'MusicTypeController@create')->middleware('regionadmin');
Route::put('/genres/edit/{musicType}', 'MusicTypeController@edit')->name('editgenre')->middleware('regionadmin');
Route::post('/genres', 'MusicTypeController@store')->name('genrestore')->middleware('regionadmin');
Route::post('/genres/{musicType}', 'MusicTypeController@update')->name('updategenre')->middleware('regionadmin');
Route::post('/genres/delete/{musicType}', 'MusicTypeController@destroy')->name('deletegenre')->middleware('admin');
Route::get('/admin/actions','AdminController@actions')->middleware('admin')->name('admin.actions');
Route::post('/admin/action/updatemanager','AdminController@updatemanager')->middleware('admin')->name('admin.updatemanager');
Route::get('/admin/action/getgenres/{dj}','AdminController@getGenres');
Route::POST('/admin/action/getgenres','AdminController@setGenres')->middleware('admin')->name('admin.updategenre');
//Route::get('/manage/djevents','AdminController@manageEvents')->middleware('manadmin');
Route::get('/admin/action/getevent/{dj}','AdminController@getEvents')->middleware('manadmin');

//admin
Route::get('/admin/messages/inbox', 'AdminController@message')->name('admin.message')->middleware('admin');
Route::get('/admin/messages/compose', 'AdminController@compose')->name('admin.message.compose')->middleware('admin');

Route::post('/admin/send/message', 'AdminController@sendMessage')->name('admin.message.send')->middleware('admin');
Route::post('/admin/message/delete', 'AdminController@removeMessage')->name('admin.message.delete')->middleware('admin');

Route::get('/read_notification', 'AdminController@read_notification')->middleware('auth');
Route::post('/read_signle_notification', 'AdminController@read_signle_notification')->middleware('auth');


//Routes for Music Campaign Audio

Route::get('/campaignaudio/create', 'MusicCampaignAudioController@create')->name('campaignaudio')->middleware('campaign');
Route::post('/campaignaudio', 'MusicCampaignAudioController@store')->name('addaudio')->middleware('campaign');
Route::get('/campaignaudio/delete/{musicCampaignAudio}', 'MusicCampaignAudioController@destroy')->middleware('campaign');


Route::get('/campaignaudio/addfingerprint/{musicCampaignAudio}', 'MusicCampaignAudioController@addMusicToFingerprint')->middleware('admin');
Route::get('/admin/missing','AdminController@managemissing')->middleware('admin');

Route::get('/djmanager', 'DjManagerController@index')->middleware('manadmin')->name('djmanager.index');
Route::get('/djmanager/invite', 'DjManagerController@invite')->middleware('manadmin')->name('djmanager.invite');
Route::get('/djmanager/create', 'DjManagerController@create')->name('djmanager.create');
Route::post('/djmanager/store', 'DjManagerController@store')->name('djmanager.store');
Route::get('/djmanager/delete', 'DjManagerController@delete')->middleware('manadmin')->name('djmanager.delete');
Route::post('/djmanager', 'DjManagerController@store')->name('adddjmanager');
Route::get('/djmanager/edit', 'DjManagerController@edit')->middleware('manadmin')->name('djmanager.edit');
Route::post('/djmanager/profileUpload', 'DjManagerController@uploadImage')->middleware('manadmin');


Route::get('/music_campaign/overview', function () {
    $currentUser = Auth::user();
    return view('DjManager.campaign_overview',compact('currentUser'));
})->name('campaign.overview');

Route::get('/current','MusicCampaignController@resetlowBalanceModal');

Route::get('/djmanagers/messages/inbox', 'DjManagerController@message')->name('djmanager.message')->middleware('manadmin');
Route::get('/djmanagers/messages/compose', 'DjManagerController@compose')->name('djmanager.message.compose')->middleware('manadmin');

Route::post('/djmanagers/send/message', 'DjManagerController@sendMessage')->name('djmanager.message.send')->middleware('manadmin');
Route::post('/djmanagers/message/delete', 'DjManagerController@removeMessage')->name('djmanager.message.delete')->middleware('manadmin');

Route::get('/djmanagers/active_campaigns','DjManagerController@getActiveCampaign')->middleware('manadmin');
Route::get('/djmanagers/active_campaigns/action/{cid}/{action}','DjManagerController@action')->middleware('manadmin');

Route::get('/music_campaign/campaign_stats', function () {
    return view('DjManager.campaign_stats');
});

Route::get('/djmanager/update', 'DjManagerController@edit')->name('djmanager.edit')->middleware('manadmin');
Route::post('/djmanager/update', 'DjManagerController@update')->middleware('manadmin');

Route::get('/spinreport', 'IdentifiedMusicController@matchResult')->middleware('auth');
Route::get('/djmanager/djspinreport/{djid}', 'IdentifiedMusicController@matchResultDJ')->middleware('manadmin');
Route::get('/djmanager/{dj}/weekly/{week}','IdentifiedMusicController@weeklyreport')->middleware('manadmin');

Route::get('/song_matched', function () {
    return view('match');
});

Route::get('/song_not_matched', function () {
    return view('notMatched');
});

Route::get('/music/download/{mca}','MusicCampaignAudioController@download')->middleware('dj');
Route::get('/dj/download/app','DjController@download')->middleware('dj');
Route::get('/dj/app/download','DjController@showdownload')->middleware('dj');
Route::get('/dj/mobile/events','DjEventsController@index');
Route::post('/dj/mobile/events','DjEventsController@store')->name('add.event')->middleware('dj');
Route::get('/dj/events/delete/{event}','DjEventsController@delete')->name('event.delete');
Route::get('/admin/mobiledj/event/update/{id}/{status}','DjEventsController@updatestatus')->middleware('manadmin');


Route::get('/registration/success', function(){
    return view('djdashboard.successfulregistration');
});


Route::get('/djlogin/success', 'DjController@clubs')->middleware('dj');
Route::post('/djlogin/success', 'DjController@addclubs')->middleware('dj');
Route::get('/dj/club/edit/{club}','DjController@editclub')->middleware('dj');
Route::post('/dj/club/update/{club}','DjController@updateClub')->middleware('dj');
Route::get('/dj/club/delete/{club}','DjController@deleteClub')->middleware('dj');
Route::get('/dj/history','DjController@matchResultDJ')->middleware('auth');
Route::get('/dj/spin/history','DjController@allResultDJ')->middleware('admin');
Route::get('/dj/list','DjController@allDj');

Route::get('/matchResult','IdentifiedMusicController@matchResult')->middleware('auth');
Route::get('/displayresult','IdentifiedMusicController@viewResults')->middleware('auth');


Route::get('/djmanager/data/yearlyactivity/{count}','DjManagerController@yearlyactivity')->middleware('manadmin');
Route::get('/djmanager/data/weeklyactivity/{count}','DjManagerController@weeklyactivity')->middleware('manadmin');
Route::get('/djmanager/manager/block/{dj}','DjManagerController@blockDj')->middleware('manadmin');
Route::get('/djmanager/manager/unblock/{dj}','DjManagerController@unblockDj')->middleware('manadmin');
Route::get('/djmanager/dj/edit/{dj}','DjManagerController@editDj')->middleware('manadmin');
Route::post('/djmanager/dj/edit/','DjManagerController@updateDj')->middleware('manadmin');
Route::get('/djmanager/manage/actions','DjManagerController@manageActions')->middleware('manadmin');
Route::get('/djmanager/campaigns','DjManagerController@allCampaigns')->middleware('manadmin');



Route::get('/matches','IdentifiedMusicAllController@matchRecords')->middleware('admin');
Route::get('/matches/djspinreport/{djid}', 'IdentifiedMusicAllController@matchResultDJ');

Route::get('/notifications','DjManagerController@getNotification')->middleware('auth');
Route::get('/notificationsv1','DjManagerController@getNotificationv1')->middleware('auth');
Route::get('/admin/clubs/verify','AdminController@verifyClubs')->middleware('admin');
Route::get('/clubs','ClubController@index');

Route::get('/dj/campaign/accept/{campaign}','AcceptedCampaignController@accept')->middleware('dj');
Route::get('/dj/campaign/leave/{campaign}','AcceptedCampaignController@leave')->middleware('dj');
Route::get('/dj/accepted/campaign','AcceptedCampaignController@accepted')->middleware('dj');

Route::get('/admin/campaign/payments','AdminController@seePayments')->middleware('admin');
Route::get('/admin/request/payments','WithdrawalRequestController@index')->middleware('admin');

Route::get('/countries','CountryController@index');
//Route::get('/country/{country}','CountryController@show');
Route::get('/country/states/{country}','CountryController@showstates');
Route::get('/state/cities/{state}','StateController@showcities');
Route::get('/city/state/{city}','CityConroller@showstate');
Route::get('/state/country/{state}','StateController@showcountry');
Route::get('/campaign/estimation','MusicCampaignController@estimation');
Route::get('/campaign/thisweek/{campaign}','MusicCampaignController@thisweek');
Route::get('/campaign','MusicCampaignController@showall')->middleware('admin');
Route::get('/campaign/addons','AddonController@index')->middleware('campaign');
Route::post('/campaign/addons','AddonController@store')->middleware('campaign')->name('campaign.addons.save');

Route::get('/djmanager/trends','DjManagerController@trends');
Route::get('/djmanager/trends/daily/{dj}','DjManagerController@dailyTrends');
Route::get('/djmanager/trends/weekly/{dj}','DjManagerController@weeklyTrends');
Route::get('/djmanager/trends/monthly/{dj}','DjManagerController@monthlyTrends');
Route::get('/djmanager/trends/yearly/{dj}','DjManagerController@yearlyTrends');
Route::get('/checkemail/{email}','MusicCampaignController@checkmail');
Route::get('/checkusername/{username}','MusicCampaignController@checkusername');
Route::get('/checkdjname/{djname}','MusicCampaignController@checkdjname');

Route::get('/dj/trends/weekly/','DjController@weeklyTrends');
Route::get('/campaign/trends/weekly/','MusicCampaign@weeklyTrends');

Route::post('/campaign/advancedFilter', 'MusicCampaignController@filterTargetAdvanced');
Route::post('/campaign/advancedEstimation', 'MusicCampaignController@estimationAdvanced');
Route::get('/admin/download/stat','AdminController@getdownloadstat');


Route::get('/tempcity', 'CityController@gettemp');

Route::get('/p/{topic}/{value}','KafkaProducer@produce');
Route::get('/p1','KafkaProducer@produce1');
Route::get('/c','KafkaConsumer@consume');
Route::get('/produce','KafkaProducer@produceMissed');
Route::get('/php-info',function(){
    return phpinfo();
});

Route::get('/mockapi','ApiAuthController@mockapi');

Route::get('/detectedmusicaction/{songid}/{userid}/{video_url}/{audioName}/{playedtime}/{club}/{timezone_offset}/{latitude}/{longitude}','ApiAuthController@responseMatch');

Route::group(['middleware' => 'campaign'], function () {
    Route::get('/campaign/new/create', 'MusicCampaignController@newCampaignView')->name('campaigncreate');
    Route::get('/campaign/list', 'MusicCampaignController@campaignList')->name('campaign.list');
    Route::post('/campaign/new/create', 'MusicCampaignController@newCampaignStore')->name('new-campaign');
    Route::get('/campaign/use/{id}', 'MusicCampaignController@campaignUse');
    Route::get('/campaign/edit/{id}', 'MusicCampaignController@campaignEdit');
    //Route::put('/campaign/edit/{id}', 'MusicCampaignController@campaignUpdate')->name('campaign.edit');

    Route::get('/advertisement/new/create', 'AdvertisementController@create');
    Route::post('/advertisement/new/create', 'AdvertisementController@store')->name('advertisement.create');
    Route::get('/advertisement/list', 'AdvertisementController@advertiseList')->name('advertisement.list');

    Route::get('/advertisement/cancel-status/{id}', 'AdvertisementController@cancelStatus')->name('advertisement.cancelStatus');
    Route::get('/advertisement/paypal/status', 'AdvertisementController@getPaymentStatus');
});


Route::get('/dj-signups','HomeController@djsignups');
Route::get('/signupModal','HomeController@signupModal');
Route::get('/selfinvitemail','HomeController@sendselfinvite');

Route::get('/advertisement/closeAds', 'AdvertisementController@closeAdsToday');
Route::get('/createpackage','MusicCampaignAudioController@createPklz');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/advertisementList', 'AdvertisementController@adminSideList')->name('advertisementList');
    Route::get('/advertisementStatusUpdate/{id}/{status}', 'AdvertisementController@statusUpdate');
    Route::get('/newAdvertisement', 'AdvertisementController@adminCreate');
    Route::post('/storeAdvertisement', 'AdvertisementController@adminStore')->name('storeAdvertisement');
    Route::get('/settings', 'SettingController@view')->name('setting');
    Route::post('/settings/store', 'SettingController@store')->name('setting.store');


    Route::get('/editAdvertisement/{id}', 'AdvertisementController@adminEdit');
    Route::post('/updateAdvertisement/{id}', 'AdvertisementController@adminUpdate')->name('advertisementUpdate');
    Route::get('/admin-notification', 'NotificationController@admin_notification');
});

Route::get('/top', 'MusicMonitorController@showTop')->name('music.monitor.top');
Route::get('/music/monitor','MusicMonitorController@index');
Route::get('/music/monitor/dj/detail/{id}/{tag}','MusicMonitorController@show')->name('music.monitor.dj.detail');
Route::get('/music/monitor/api', 'MusicMonitorController@api');

Route::get('/payments/paypal/manual/{wr}','PaypalController@manualPayment')->middleware('admin');
Route::get('/admin/actions2','AdminController@showmanualspinindex')->middleware('admin');
Route::post('/admin/actions2','AdminController@producespinmessage')->middleware('admin')->name('spin.missing');
Route::get('/invitecampaign','DjController@viewinvitecampaign')->middleware('auth')->name('viewinvitecampaign');
Route::post('/dj/invitecampaign','DjController@invitecampaign')->middleware('auth')->name('invitecampaign');

Route::get('/dj-notification','NotificationController@dj_notification')->middleware('auth');
Route::get('/djmanager-notification','NotificationController@djmanager_notification')->middleware('auth');
Route::get('/campaign-notification','NotificationController@campaign_notification')->middleware('auth');



Route::get('/advertisers','AdvertiserController@index')->middleware('admin')->name('advertisers');
Route::post('/advertiser/add','AdvertiserController@create')->middleware('admin');
Route::post('/employee/add','AdvertiserController@createemployee')->middleware('advertiser');
Route::get('/advertiser','AdvertiserController@home')->middleware('advertiser')->name('advertiser');
Route::get('/advertiser/request/payment','WithdrawalRequestController@requestPayment')->middleware('advertiser');
Route::post('/advertiser/update','AdvertiserController@update')->name('advertiser.update.percent');
Route::get('/advertiser/profile/edit','AdvertiserController@edit')->middleware('advertiser')->name('advertiser.edit');
Route::post('/advertiser/profile/update','AdvertiserController@updateProfile')->middleware('advertiser')->name('advertiser.update');
Route::get('/employees','AdvertiserController@employees')->middleware('advertiser')->name('employees');
Route::get('/employee/details/{advertiser}','AdvertiserController@viewEmployee')->middleware('auth')->name('employee.view');
Route::get('/employee/disable/{advertiser}','AdvertiserController@disableEmployee')->middleware('auth')->name('employee.disable');
Route::get('/employee/enable/{advertiser}','AdvertiserController@enableEmployee')->middleware('auth')->name('employee.enable');
Route::get('/advertiser/details/{advertiser}','AdvertiserController@view')->middleware('auth')->name('advertiser.view');

Route::get('/keyer','ManualMusicIdentificationController@getMusicForManualIdentification')->middleware('keyer');
Route::get('/update/spins','ManualMusicIdentificationController@updatematch')->middleware('keyer');


Route::prefix('artistmanager')
    ->group(base_path('routes/artistmanager.php'));
Route::get('/admin/artistmanager','ArtistManagerController@list')->middleware('admin');
Route::post('/admin/artistmanager','ArtistManagerController@updateCampaignManager')->middleware('admin')->name('admin.artistmanager');
Route::post('/admin/artistmanager/add','ArtistManagerController@store')->middleware('admin')->name('admin.artistmanager.add');
Route::get('/admin/regionadmin','AdminController@regionadmin')->name('admin.regionadmin');
Route::post('/admin/regionadmin/add','RegionAdminController@store')->middleware('admin')->name('admin.regionadmin.add');



Route::get("/pusher/publish", function (){
    event(new GenericEvent("music-played", 177,'{"music":121}'));
});


Route::get('/huddle','HuddleManagerController@index')->middleware('manadmin');
Route::get('/huddle/{musicCampaign}','HuddleManagerController@result');
Route::get('/dj/missing/key','DjController@getMusicForManualIdentification')->middleware('dj');

Route::get('/keying/agree','ManualMusicIdentificationController@agreeKeying')->middleware('auth');
Route::get('/keying/disagree','ManualMusicIdentificationController@disagreeKeying')->middleware('auth');
Route::get('/review','ManualMusicIdentificationController@review')->middleware('keyer');
Route::post('/testonesignal', function (\Illuminate\Http\Request $request){
    $responseObj = [
        'campaignAudioId' => $request->campaignAudioId,
        'campaignId' => $request->campaignId,
        'source' => 'new_music_added'

    ];
    $message = "Your music titled as " . $request->song_title . " has been added to your genre ";
    App\Helpers\PushNotification::sendToTag('dj', $responseObj, $message);
   return $request->all();
});



Route::group(['middleware' => 'regionadmin', 'prefix' => 'regionadmin', 'as' => 'regionadmin.'], function () {
    Route::get('{region}/', 'RegionAdminController@index')->name('index');
    Route::get('/{region}/payments','RegionAdminController@seePayments')->name('payments');
    Route::get('/{region}/actions','RegionAdminController@actions')->name('actions');
});



Route::get('/backupspinrate','SettingController@backupspinrate')->middleware('admin')->name('backupspinrate');
Route::get('/restorespinrate','SettingController@restorespinrate')->middleware('admin')->name('restorespinrate');
Route::get('/setspinrate','SettingController@setspinrate')->middleware('admin')->name('setspinrate');
Route::get('/newregister', 'DjController@newregister');
Route::post('/newregister', 'DjController@storenewregister')->name('newlogin');
Route::get('cron/artist_low_balance','CronController@index')->name('cron/artist_low_balance');


Route::get('/login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('/google/register', 'Auth\LoginController@handleGoogleCallback');
Route::get('/campaign/complete_profile','MusicCampaignController@complete_profile')->name('campaign.completeprofile');
