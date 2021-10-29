<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ChangeProfile(){
        if(Auth::user()){
            $userProfile = User::find(Auth::user()->id);
            if($userProfile){
                return view('admin.user.user_profile', compact('userProfile'));
            }

        }
    }
    
    public function ProfileUpdate(Request $request){

        $validated = $request->validate(
            [
                'profile_name' => 'required',
                'profile_email' => 'required',
            ]
            );

        $userProfile = User::find(Auth::user()->id);
        if($userProfile){
            


            $userProfile->name = $request->profile_name;
            $userProfile->email = $request->profile_email;
            $userProfile->save();
             
            return redirect()->back()->with('success', 'Profile Updated Successfuly');
        }else {
            return redirect()->back()->with('error', 'Profile Updated Failed');
        }
    }
}
