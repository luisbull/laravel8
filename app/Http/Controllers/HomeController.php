<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    ////////////
    // CREATE //
    ////////////
    public function AddSlider(Request $request){
        return view('admin.slider.create');
    }

    ///////////
    // STORE //
    ///////////
    public function StoreSlider(Request $request){
        $validated = $request->validate(
            [
                'title' => 'required|unique:sliders|min:4',
                'description' => 'required',
                'image' => 'required|mimes:jpg,jpeg,bmp,png,svg|max:1048',
            ],
            [
                'title.required' => 'Please enter slider title', // here can be customised text instead of default message
                //  'title.min' => 'Min 20' // here can be customised text instead of default message
                //  'image.mimes' => 'Only jpg,jpeg,bmp,png,svg accepted' // here can be customised text instead of default message
            ], 
        );

        $slider_image = $request->file('image');
        $up_location = 'image/slider';  
        // keep ratio height and width
        Image::make($slider_image)->resize(null, 1088, function($constraint) {
            $constraint->aspectRatio();
        })->save();

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $slider_image->store($up_location, 'public'), //for this to work remember, run in terminal: php artisan storage:link //
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
    }

    //////////
    // EDIT //
    //////////
    public function Edit($id){
        $sliders = Slider::find($id);
        return view('admin/slider/edit', compact('sliders')); 
    }

    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validated = $request->validate(
            [
                'slider_title' => 'required|min:4',
                'slider_description' => 'required',
                // 'slider_image' => 'required|mimes:jpg,jpeg,bmp,png,svg|max:1048',
            ],
            [
                'slider_title.required' => 'HOLAPlease enter slider title', // here can be customised text instead of default message
                //  'title.min' => 'Min 20' // here can be customised text instead of default message
                'slider_description.requires' => 'necesitas las descripcion'
                //  'image.mimes' => 'Only jpg,jpeg,bmp,png,svg accepted' // here can be customised text instead of default message
            ], 
        );

        $slider_image = $request->file('slider_image');
        
        $up_location = 'image/slider';
        
        $slider_entry = Slider::find($id);
        $old_image = public_path('storage/'.$slider_entry->image);
        
        if($slider_image){
            if(File::exists($old_image)){
                File::delete($old_image);
                
                Slider::find($id)->update([
                    'title' => $request->slider_title,
                    'description' => $request->slider_description,
                    'image' => $slider_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);
    
                return redirect()->back()->with('success', 'Slider Updated Successfully');    
            
            }else{
                Slider::find($id)->update([
                    'title' => $request->slider_title,
                    'description' => $request->slider_description,
                    'image' => $slider_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);

                return redirect()->back()->with('success', 'Slider Updated Successfully');
            }
        }else{
            Slider::find($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_description,
                // 'image' => $brand_image->store($up_loacation, 'public'),
                // store('uploads', 'public')
                // 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Slider Updated Successfully');
        }
    }
}
