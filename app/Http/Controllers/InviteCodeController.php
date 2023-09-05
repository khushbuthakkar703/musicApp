<?php

namespace App\Http\Controllers;

use App\InviteCode;
use App\Dj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Log;
use Auth;
use App\DjManager;


class InviteCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('invite.index');
    }

    public function invite(Request $data)
    {
        $id = auth()->id();
        $user = auth()->user();

        $this->validate($data, [
            'email' => 'required|unique:invite_codes,email',
            'role'  => 'required',
        ]);

        $reciptant = $data->email;

        $invite = new InviteCode();
        $invite->token = mt_rand(10000000, 99999999);
        $invite->email = strtolower($reciptant);
        $invite->invited_by = $id;
        $invite->created = 0;
        $invite->user_type = $data->role;
        $invite->save();

        $djmanager = DjManager::find($id);
        $managerName = $djmanager->first_name .' ' . $djmanager->last_name;

        if ($data->role == 'dj') {
            $result = Mail::send('email.djinvitation', ['cc' => $invite->token, 'reciptant' => $reciptant], function ($message) use ($reciptant, $managerName) {
                $message->to($reciptant, 'DJ')->subject($managerName .' is sending you a DJ invite to SpinStatz');
            });
        } else if ($data->role == 'djmanager') {
            $result = Mail::send('email.managerinvitation', ['cc' => $invite->token, 'reciptant' => $reciptant], function ($message) use ($reciptant) {
                $message->to($reciptant, 'Manager')->subject('SpinStatz Coalition Invitation');
            });
        }

        if (count(Mail::failures()) > 0) {
            return redirect()->route('inviteform')->with('error', "Failed to send invitation, please try again.");
        }
        return redirect()->route('inviteform')->with('message', "Invitation Sent");
    }

    public function bulkinvite(Request $data)
    {

        $logFile = 'laravel.log';
        Log::useDailyFiles(storage_path() . '/logs/' . $logFile);
        $user = auth()->user();
        //return $user->role;


        $this->validate($data, [
            'emails' => 'required',
        ]);

        $emailList = explode("\n", $data->emails);

        if ($user->role == 'admin') {
            $invitatantRole = $data->role;
            $redirectRoute = "bulkindex";

        } else if($user->role == 'djmanager') {
            $invitatantRole = "dj";
            $redirectRoute = "djmanager.index";
        }else{
            $invitatantRole = 'djmanager';
            $redirectRoute = "djmanager.index";
        }


        $count = 0;
        $manId = auth()->user()->id;
        $djmanager = DjManager::where('user_id',$manId)->first();
        $managerName = $djmanager->first_name .' ' . $djmanager->last_name;

        foreach ($emailList as $reciptant) {

            $reciptant = trim($reciptant);
            $invite = new InviteCode();
            $invite->token = mt_rand(10000000, 99999999);
            $invite->email = strtolower($reciptant);
            $invite->user_type = $invitatantRole;
            $invite->invited_by = $manId;
            $invite->created = 0;

            try {
                $invite->save();

                Mail::send('email.djinvitation', ['cc' => $invite->token, 'reciptant' => $reciptant], function ($message) use ($reciptant, $managerName) {
                    $message->to($reciptant, 'DJ')->subject($managerName .' is sending you a DJ invite to SpinStatz');
                });

                $count++;

            } catch (\Exception $e) {
                Log::error($e);
                $invite->delete();

            }

        }
        return redirect()->route($redirectRoute)->with('message', "Invitation sent to " . $count . " emails");

        //return $data->emails;

    }

    public function bulkindex()
    {
        return view('invite.bulkindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InviteCode $inviteCode
     * @return \Illuminate\Http\Response
     */
    public function show(InviteCode $inviteCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InviteCode $inviteCode
     * @return \Illuminate\Http\Response
     */
    public function edit(InviteCode $inviteCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\InviteCode $inviteCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InviteCode $inviteCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InviteCode $inviteCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(InviteCode $inviteCode)
    {
        //
    }

    public function invitedEmail()
    {
        $currentUser = auth()->user();
        $notAcceptedInvitations = InviteCode::where('invited_by',$currentUser->id)
                        //->select('email','created_at','updated_at')
                        ->where('created',0)
                        ->orderBy('updated_at','asc')
                        ->get();
        
        $acceptedInvitations = Dj::where('invited_by',$currentUser->id)->get();
        
        return view('admin.invitedEmail',compact('notAcceptedInvitations','acceptedInvitations'));

    }

    public function get_dataTable()
    {
        $levels = Level::select(['id', 'title', 'created_at'])->get();
        $invitations = InviteCode::get();

        return Datatables::of($levels)
            ->addColumn('action', function ($invitations) {
                return '
                    <button data-toggle="modal" data-target="#edit-myModal"  data-level_id="' . $invitations->id . '"
                            data-edit-link=' . route("editinvitation", $invitations->id) . '  id="editId" type="submit"
                            class="btn btn-primary actionBtn editButton">
                            Edit                            
                     </button> 
                            
                    <span style="display: inline-block">
                        <form action=' . route("deleteinvitation", $invitations->id) . ' method="post">
                                ' . csrf_field() . '
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Delete" class= "btn btn-danger actionBtn confirm"  data-confirm="Are you sure you want to delete?"/>
                        </form>
                    </span>
                    
                    ';

            })->make(true);

    }

    public function reInvite(InviteCode $invite){
        $id = Auth::id();
        $djmanager = Auth::user()->manager()->first();
        $managerName = $djmanager->first_name .' ' . $djmanager->last_name;

        if($invite->invited_by == $id){
            
            $reciptant = $invite->email;
            Mail::send('email.djinvitation', ['cc' => $invite->token, 'reciptant' => $reciptant], function ($message) use ($reciptant, $managerName) {
                    $message->to($reciptant, 'DJ')->subject($managerName .' is sending you a DJ invite to SpinStatz');
                });
            $invite->updated_at = \Carbon\Carbon::now();
            $invite->save();
            return array("response"=>"success");
        
        }else{
            return array("response"=>"failed");
        }
        
    }

    public function delete(InviteCode $invite){
        $id = Auth::id();
        if($invite->invited_by == $id){
            $invite->delete();
            return array("response"=>"success");
        }else{
            return array("response"=>"failed");
        }
        
    }
}
