<?php

namespace App\Http\Controllers\Auth;

use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    if($request->isMethod('get')){
      $invitation = Invitation::where('invitation_token', $request->invitation_token)->get();
      $remail = $invitation[0]->email;
    }
     return view('auth.register',compact('remail'));
  }

  public function storeUser(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:8|confirmed',
          'password_confirmation' => 'required',
      ]);

      User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
      ]);

      Invitation::where('email', $request->email)->update(array('user_registered_at' => Carbon::now()));

      return redirect('login');
  }


}