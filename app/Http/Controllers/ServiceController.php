<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function HomeService(){
        $homeService = Service::latest()->get();
        return view('admin.servics.index', compact('homeService'));
    }

    ////////////
    // CREATE //
    ////////////
    public function AddService(){
        return view('admin.servics.create');
    }

    ///////////
    // STORE //
    ///////////
    public function StoreService(Request $request){
        $validate = $request->validate(
            [
                'icon' => 'required',
                'name' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'Please enter title name'
            ],
        );

        Service::insert([
            'service_icon' => $request->icon,
            'service_name' => $request->name,
            'service_description' => $request->description,
            'created_at' => Carbon::now()
        ]);
        
        return redirect()->route('home.service')->with('success', 'Service Created Successfully');

    }

    //////////
    // EDIT //
    //////////
    public function Edit($id){
        $homeService = Service::find($id);
        return view('admin/servics/edit', compact('homeService'));
    }

    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validate = $request->validate(
            [
                'icon' => 'required',
                'name' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'Please enter title name'
            ],
        );
        
        Service::find($id)->update([
            'service_icon' => $request->icon,
            'service_name' => $request->name,
            'service_description' => $request->description,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('home.service')->with('success', 'Service Updated Successfully');
        
    }

    public function Delete($id){
        Service::find($id)->delete();
        return redirect()->back()->with('success', 'Service Deleted Successfully');
    }

        
    
}
