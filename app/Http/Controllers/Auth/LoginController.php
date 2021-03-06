<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {

      return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('email', 'password', 'status');

        dd($credentials);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin');
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
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