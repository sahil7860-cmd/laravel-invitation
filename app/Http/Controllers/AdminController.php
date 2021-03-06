<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){

        $users = User::where('role','C')->get();

        return view('admin.index', compact('users'));
    }
}
