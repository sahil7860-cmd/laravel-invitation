<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {

      return view('auth.login');
    }

    public function loginUser(Request $request)
    {
      $this->validate($request, [
        'email'=> 'required|email',
        'password'=> 'required',
    ]);
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('status','Invalid login credentials');
        }

        // return redirect()->route('dashboard');

        $user = User::where('email',$request->email)->get();
         
       if($user[0]->status == 'A'){
        if($user[0]->role == 'A'){
          return redirect()->route('admin');
        }else{
          return redirect()->route('client');

        } 
        }else{
           return redirect()->route('home');
        }
        

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials Or your account is deactivated');
    }

    public function logout() {
      Auth::logout();
      return redirect('login');
    }

    public function home()
    {

      return view('home');
    }
}