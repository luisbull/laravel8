<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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

        
        $profile_image = $request->file('profile_image');
        // dd($profile_image);
        $user_profile_location = 'profile-photos';
        
        $userProfile = User::find(Auth::user()->id);
        $old_profile_image = public_path('storage/'.$userProfile->profile_photo_path);
        if($profile_image){
            if(File::exists($old_profile_image)){
                // unlink($old_profile_image); // also works
                File::delete($old_profile_image);

                $userProfile->update([
                        'name' => $request->profile_name,
                        'email' => $request->profile_email,
                        'profile_photo_path' => $profile_image->store($user_profile_location, 'public'),
                        // store('uploads', 'public')
                        'updated_at' => Carbon::now()
                ]);
        
                return redirect()->back()->with('success', 'Profile Updated Successfuly');

            }else{
                // dd('NO OLD '.$old_profile_image);
                $userProfile->update([
                    'name' => $request->profile_name,
                    'email' => $request->profile_email,
                    'profile_photo_path' => $profile_image->store($user_profile_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);
    
                return redirect()->back()->with('success', 'Profile Updated Successfuly');

            }
        }else{
            $userProfile->update([
                'name' => $request->profile_name,
                'email' => $request->profile_email,
                // 'profile_photo_path' => $profile_image->store($user_profile_location, 'public'),
                // store('uploads', 'public')
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Profile Updated Successfuly');
        }

    }
}
