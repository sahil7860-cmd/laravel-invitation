<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Mail\invitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    
    // public function __construct(){
    //     $this->middleware(['admin']);
    // }

    public function store(Request $request){

        $request->validate([
            'email' => 'required|string|email',
        ]);
        $invitationToken = substr(md5(rand(0, 9) . $request->email . time()), 0, 32);    
        Invitation::create([
            'email' => $request->email,
            'invitation_token' =>  $invitationToken     
        ]) ;  

        $data = array(
            'email'      =>  $request->email,
            'invitation_link'   =>   urldecode(route('register') . '?invitation_token=' .  $invitationToken)
        );
        Mail::to($request->email)->send(new invitationMail($data));

        return redirect()->back()
            ->with('success', 'Invitation to register successfully requested. Please wait for registration link.');

        }

        public function sendInvitation() {
            $invitations = Invitation::all();
             
            return view('auth.request',compact('invitations'));
            }
        
            public function enable(Request $request){
              User::where('id', $request->id)->update(array('status' => 'A'));
              return redirect()->back();
            }
        
            public function disable(Request $request){
              User::where('id', $request->id)->update(array('status' => 'D'));
              return redirect()->back();
              
            }
}
