<?php

namespace App\Http\Controllers\Auth;

use App\Dj_Music;
use App\MusicType;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return redirect('login');
    }

    public function register()
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function registerdj(){
        $musicTypes = MusicType::get();
        return view('v3.layouts.background', compact('musicTypes'));
    }

    public function registercampaign(Request $request){
        $package = $request->get('package');
        \Session::put('new_campaign_package', $package);
        return view('v3.layouts.campaignsignup');
    }

    public function storeregisterdj(Request $request){
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users,email',
            'city'=>'required',
            'address'=>'required',
            'password'=>'required',
            'zipcode'=>'required',
            'phoneno'=>'required|unique:djs,phone_number',
            'dj_type'=>'required',
            'dj_name'=>'required|unique:djs,dj_name',
        ]);

        $cc = str_random(30);


        \DB::beginTransaction();
        $user = User::create([
            'username' => $request->email,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'dj',
            'blocked' => 'no',
            'confirmation_code' => $cc,
            'confirmed' => 0,
        ]);

        $id = $user->id;

        $dj = \App\Dj::create([
            'first_name'=> $request->fname,
            'last_name'=>$request->lname,
            'dj_name'=>$request->dj_name,
            'club_name'=> 'deleteThisfield',
            'phone_number'=> $request->phoneno,
            'user_id'=>$id,
            'city'=>$request->city,
            'software'=>'n/a',
            'invited_by'=>2,
            'type'=>$request->dj_type,
            'address'=> $request->address,
            'zipcode'=>$request->zipcode,
            'slug'=>$request->dj_name . $id
        ]);


        $musicTypes = $request->musictype;
        if ($musicTypes != null) {
            foreach ($musicTypes as $musicType) {
                $djMusic = new Dj_Music();
                $djMusic->dj_id = $id;
                $djMusic->music_type = $musicType;
                $djMusic->save();
            }
        }

        $reciptant = $user->email;
        Mail::send('email.verification', ['link' => '/register/verify/' . $cc,
            'username' => $request->username
        ], function ($message) use ($reciptant) {
            $message->to($reciptant, '')->subject('Confirm DJ Registration- SpinStatz.net');
        });

        \DB::commit();
        return redirect()->route('login')->withMessage('Please check your email address to verify your account');
    }

    public function storeregistercampaign(Request $request){

        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users,email',
//            'city'=>'required',
//            'address'=>'required',
            'password'=>'required',
//            'zipcode'=>'required',
            'phoneno'=>'required',
        ]);


        if ($validator->fails()) {
            if(request()->segment(1) == "api"){
                return response()->json($validator->errors(), 400);
            }else{
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }


        $cc = str_random(30);


        \DB::beginTransaction();
        $id = User::create([
            'username' => $request->email,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'campaign',
            'blocked' => 'no',
            'confirmation_code' => $cc,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'confirmed' => 0,
        ])->id;

        \App\MusicCampaign::create([
            'user_id' => $id,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'name' => "Primary",
            'email' =>$request->email,
            'company_name' => "delete",
            'city' =>$request->city,
            'street' =>$request->address,
            'zipcode' =>$request->zipcode,
            'phone' =>$request->phoneno,
            'campaign_balance' => 0,
            'target_country' => '[]',
            'target_state' =>'[]',
            'target_city' =>'[]',
            'target_colition' =>'[]',
            'referid' => 1
        ]);

        $reciptant = $request->email;
        Mail::send('email.verification', ['link' => '/register/verify/' . $cc,
            'username' => $request->username
        ], function ($message) use ($reciptant) {
            $message->to($reciptant, '')->subject('Confirm Campaign Registration- SpinStatz.net');
        });
        \DB::commit();

        if(request()->segment(1) == "api"){
            return response()->json(['message'=>'Please check your email address to verify your account'], 200);
        }
        return redirect()->route('login')->withMessage('Please check your email address to verify your account');
    }
}
