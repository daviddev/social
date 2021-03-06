<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
    public function profile(){
    	return view('/profiles/profile');	
    }

     public function addProfile(Request $request){
    	$this->validate($request,[
    		'name' => 'required',
    		'profile_image' => 'required',
    	]);	
    	$profiles = new Profile;
      $profiles->name = $request->input('name');
    	$profiles->user_id = Auth::user()->id;
    	if(Input::hasFile('profile_image')){
           $file = Input::file('profile_image');
           $file -> move(public_path().'/uploads/', $file->
           getClientOriginalName());
		   $url = URL::to("/") . '/uploads/' . $file-> getClientOriginalName();

        }
    	$profiles->profile_image = $url;	
    	$profiles->save();
      return redirect('/home')->
    	with('response','Profile Added Succesfully');

    }
}
