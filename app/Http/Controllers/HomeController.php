<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
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
}
