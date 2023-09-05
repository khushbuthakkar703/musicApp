<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function djsignups(Request $request){
        $manager = $request->manager;

        if($manager == null){
            $manager = 2;    
        }
        
        return view('dj.selfinvite',compact('manager'));
    }


    public function signupModal(Request $request){
        $manager = $request->manager;

        if($manager == null){
            $manager = 2;
        }

        return view('dj.inviteModal',compact('manager'));
    }

    public function sendselfinvite(){
        $reciptant = request()->email;
        $manager = request()->manager;

        $invite = new \App\InviteCode();
        $invite->email = strtolower($reciptant);

        $invitation = \App\InviteCode::where('email', $invite->email)->first();
        
        if($invitation != null){
            $manager = \App\User::find($invitation->invited_by)->manager()->first();
            $subject = $manager->first_name .  ' ' . $manager->last_name ." sending you invitation";
            $invite->token = $invitation->token;
        }else{
            $subject = 'You requested a DJ invite';
            $invite->created = 0;
            $invite->user_type = 'dj';
            $invite->invited_by = $manager;
            $invite->token = mt_rand(10000000, 99999999);
            $invite->save();
        }    
        
            $result = Mail::send('email.djinvitation', ['cc' => $invite->token, 'reciptant' => $reciptant], function ($message) use ($reciptant, $subject) {
                    $message->to($reciptant, 'DJ')->subject($subject);
            });

            return response()->json(['status'=>'ok'],200);
        }

}
