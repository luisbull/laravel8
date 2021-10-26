<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ChangePassword(){
        return view('admin.userPWD.user_password');
    }

    public function PasswordUpdate(Request $request){
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('login')->with('success', 'Password Updated Successfuly');
        } else {
            return redirect()->back()->with('error', 'Invalid. Old password does not match');
        }


    }
}
