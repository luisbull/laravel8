<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMailable;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function ContactMessage(){
        $contactMessage = Message::all();
        // $contactMessage = Message::latest()->paginate(8);
        // return view('layouts.pages.contact');
        return view('admin.message.index', compact('contactMessage'));
    }

    ////////////
    // CREATE //
    ////////////
    public function AddMessage(){
        return view('admin.message.create');
    }
    
    ///////////
    // STORE //
    ///////////
    public function StoreMessage(Request $request){
        $validate = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'name.required' => 'Please enter name', // here can be customised text instead of default message
            ],
        );


        Message::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $email = new ContactUsMailable($request->all());
        // dd($email);
        Mail::to('prueba@prueba.com')->send($email);

        return redirect()->back()->with('success', 'Message Sent Successfully');

    }

    //////////
    // EDIT //
    //////////
    public function Edit($id){
        $contactMessage = Message::find($id);
        return view('admin/message/edit', compact('contactMessage'));
    }

    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validate = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'name.required' => 'Please enter name',
            ],
        );
        
        Message::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('contact.message')->with('success','Message Updated Succesfully');
    }

    ////////////
    // DELETE //
    ////////////
    public function Delete($id){
        Message::find($id)->delete();
        return redirect()->back()->with('success', 'Message Deleted Successfully');
    }
}
