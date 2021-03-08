<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // public function __construct(){
    //     $this->middleware(['admin']);
    // }

    function index(){

        $users = User::where('role','C')->get();

        return view('admin.index', compact('users'));
    }

   
}
