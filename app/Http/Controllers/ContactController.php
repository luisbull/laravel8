<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function HomeContact(){
        $homeContact = Contact::all();
        // return view('layouts.pages.contact');
        return view('admin.contact.index', compact('homeContact'));
    }

    ////////////
    // CREATE //
    ////////////
    public function AddContact(){
        return view('admin.contact.create');
    }
    
    ///////////
    // STORE //
    ///////////
    public function StoreContact(Request $request){
        $validate = $request->validate(
            [
                'address' => 'required|unique:contacts|min:4',
                'email' => 'required',
                'phone' => 'required',
            ],
            [
                'address.required' => 'Please enter about address', // here can be customised text instead of default message
                //  'title.min' => 'Min 20' // here can be customised text instead of default message
                //  'image.mimes' => 'Only jpg,jpeg,bmp,png,svg accepted' // here can be customised text instead of default message
            ],
        );


        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('home.contact')->with('success', 'Contact Inserted Successfully');

    }

    //////////
    // EDIT //
    //////////
    public function Edit($id){
        $homeContact = Contact::find($id);
        return view('admin/contact/edit', compact('homeContact'));
    }

    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validate = $request->validate(
            [
                'address' => 'required|min:4',
                'email' => 'required',
                'phone' => 'required',
            ],
            [
                'address.required' => 'Please enter address',
            ],
        );
        
        Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()
        ]);


        return redirect()->route('home.contact')->with('success','Contact Updated Succesfully');
    }

    ////////////
    // DELETE //
    ////////////
    public function Delete($id){
        Contact::find($id)->delete();

        return redirect()->back()->with('success', 'Contact Deleted Successfully');
    }
}
