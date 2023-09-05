<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\FingerprintAndIP;
use Illuminate\Http\Request;

use App\MusicCampaign;
use App\MusicCampaignAudio;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Session;
use Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function storeInfo(Request $request)
    {
        $userid = Auth::Id();
        $oldDevices = FingerprintAndIP::where('uid', $userid);
        //error_log($oldDevices->get());

        $oldDeviceCount = $oldDevices->count();
        //dd($oldDeviceCount);
        if ($oldDeviceCount == 0) {
            $fnew = new FingerprintAndIP();
            $fnew->uid = $userid;
            $fnew->fingerprint = $request->fingerprint;
            $fnew->save();

            return true;
        } else {
            //$matcholdDevice = $oldDevices->where('fingerprint','=',$request->fingerprint)->count();
            $matcholdDevice = $oldDevices->where('fingerprint', '=', $request->fingerprint)->get();


            if (empty($matcholdDevice->count() == 1)) {
                //$request->session()->invalidate();
                //return false;
            }

            $user = Auth::user();
            if($user->role == 'regionadmin'){

                Session::put('region-country',$user->regionAdmin()->first()->countries()->pluck('id'));
            }
            return true;
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $email = $request->get('email');
        $client = User::where('email', $email)->first();

        if ($client != null)
            if ($client->confirmed === 0) {
                //return $this->sendFailedLoginResponse($request);
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->with('error', 'Please check your email address to verify your account');
            }

        if ($this->attemptLogin($request)) {
            if ($this->storeInfo($request))
                return $this->sendLoginResponse($request);
            else
                return redirect('/')->with('error', 'Please Use Device you used while login first time');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logOut()
    {

        Auth::logout();
        \Session::forget('user');

        setcookie('disableAdPopUp', false, time() - 3600, "/");

        return redirect('/');

    }

    protected function redirectPath()
    {
        $role = auth()->user()->role;

        if ($role == 'djmanager') {
            return "djmanager";
        } else if ($role == 'campaign') {

            $campaign = MusicCampaign::where('user_id', Auth::id())->first();

            $audioCount = 0;
            if (isset($campaign->id)) {
                $audioCount = MusicCampaignAudio::where('campaign_id', $campaign->id)->count();
            }

            //return $campaign->id;
            if ($audioCount == 0) {
                return "/campaignaudio/create";
            } else {
                return '/campaign/dashboard';
            }


        } else if ($role == 'dj') {
            return "/dj/dashboard";
        } else if ($role == 'admin') {
            return "/genres";
        }else if ($role == 'advertiser'){
            return "/advertiser";
        }else if ($role == 'artistmanager'){
            return "/artistmanager";
        }else if ($role == 'keyer'){
            return "/keyer";
        }else if ($role == "regionadmin"){
            return "/regionadmin/".auth()->user()->id;
        }

    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();




        $this->_registerOrLoginUser($user);

        return redirect()->route('campaign.completeprofile');
        // $user->token;
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('google')->user();

        // $user->token;
    }

    protected function _registerOrLoginUser($data) {


        $user = User::where('email', $data->email)->first();
        if(!$user){
            \DB::beginTransaction();
            $user = \App\User::create([
                'username' => $data->email,
                'email' => $data->email,
                'password' => bcrypt("bikashsapkota12477"),
                'role' => 'campaign',
                'blocked' => 'no',
                'confirmation_code' => "cc",
                'confirmed' => 1,
            ]);



            \App\MusicCampaign::create([
                'user_id' => $user->id,
                'first_name' => $data->user['given_name'],
                'last_name' => $data->user['family_name'],
                'campaign_name' => "Primary",
                'email' =>$data->email,
                'company_name' => "delete",
                'campaign_balance' => 0,
                'target_country' => '[]',
                'target_state' =>'[]',
                'target_city' =>'[]',
                'target_colition' =>'[]',
                'referid' => 1
            ]);

            \DB::commit();
        }
        Auth::login($user);
    }
}
