<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function HomeAbout(){
        $homeAbout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeAbout'));
    }
    
    ////////////
    // CREATE //
    ////////////
    public function AddAbout(){
        return view('admin.home.create');
    }
    
    ///////////
    // STORE //
    ///////////
    public function StoreAbout(Request $request){
        $validate = $request->validate(
            [
                'title' => 'required|unique:home_abouts|min:4',
                'short_description' => 'required',
                'long_description' => 'required',
            ],
            [
                'title.required' => 'Please enter about title', // here can be customised text instead of default message
                //  'title.min' => 'Min 20' // here can be customised text instead of default message
                //  'image.mimes' => 'Only jpg,jpeg,bmp,png,svg accepted' // here can be customised text instead of default message
            ],
        );


        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('home.about')->with('success', 'About Inserted Successfully');

    }

    //////////
    // EDIT //
    //////////
    public function Edit($id){
        $homeAbout = HomeAbout::find($id);
        return view('admin/home/edit', compact('homeAbout'));
    }

    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validate = $request->validate(
            [
                'title' => 'required|min:4',
                'short_description' => 'required',
                'long_description' => 'required',
            ],
            [
                'title.required' => 'Please enter about tilte',
            ],
        );
        
        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'updated_at' => Carbon::now()
        ]);


        return redirect()->route('home.about')->with('success','About Updated Succesfully');
    }

    ////////////
    // DELETE //
    ////////////
    public function Delete($id){
        HomeAbout::find($id)->delete();

        return redirect()->back()->with('success', 'About Deleted Successfully');
    }

}
