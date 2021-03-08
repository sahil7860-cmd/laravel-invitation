<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    // public function __construct(){
    //     $this->middleware(['client']);
    // }

    public function index(){
        $user = User::where('id', auth()->user()->id);
        return view('client.index',compact('user'));
    }
    function uploadAvatar(Request $request){
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('avatar');
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $adminFfileNameToStore = $filename.'admin_'.time().'.'.$extension;
  
       
        $save = $this->resizeImage($file, $fileNameToStore,64);
        $admin_save = $this->resizeImage($file, $adminFfileNameToStore,256);
        $user = Auth::user();
        $user->avatar = $fileNameToStore;
        $user->admin_avatar = $adminFfileNameToStore;
        $user->save();

  
        return back()->with('success','You have successfully upload image.');

    }

    public function resizeImage($file, $fileNameToStore,$size) {
        // Resize image
        $resize = Image::make($file)->resize($size,$size)->encode('jpg');
  
        // Create hash value
        $hash = md5($resize->__toString());
  
        // Prepare qualified image name
        $image = $hash."jpg";
  
        // Put image to storage
        $save = Storage::put("/avatars/{$fileNameToStore}", $resize->__toString());
  
        if($save) {
          return true;
        }
        return false;
      }
}
