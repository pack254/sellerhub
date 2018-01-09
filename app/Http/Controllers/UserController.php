<?php

namespace storeHub\Http\Controllers;

use Illuminate\Http\Request;
use storeHub\Http\Requests;
use Auth;
use Image;
use storeHub\User;
use File;

class UserController extends Controller
{
    //
    public function profile(){
    	return view('profile', array('user' => Auth::user()) );
    }

    public function update_avatar(Request $request){
      $user = User::find(Auth::user()->id);
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();

        if ($user->avatar !== 'default.png') {
            $oldFile = 'upload/avatars/' . $user->avatar;
            if (File::exists($oldFile)) {
                unlink($oldFile);
                //echo "remove picture\n";
                //echo $oldFile;
            }
        }

    		Image::make($avatar)->resize(300, 300)->save( public_path('/upload/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('profile', array('user' => Auth::user()) );
    }
}
