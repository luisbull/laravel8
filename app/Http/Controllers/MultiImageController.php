<?php

namespace App\Http\Controllers;

use App\Models\MultiPic;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class MultiImageController extends Controller
{
    public function AllImages(){
        $allImages = MultiPic::all();
        return view('admin.pics.index', compact('allImages'));
    }

    public function StoreImages(Request $request){
        // $validated = $request->validate(
        //     [
        //         'brand_name' => 'required|unique:brands|min:4',
        //         'image' => 'required|mimes:jpg,jpeg,bmp,png,svg',
        //     ],
        //     [
        //         'brand_name.required' => 'Please enter brand name', // here can be customised text instead of default message
        //         //  'brand_name.min' => 'Min 20' // here can be customised text instead of default message
        //     ], 
        // );

        $array_of_images = $request->file('image');
        $up_location = 'image/allpictures';  

        foreach($array_of_images as $single_image){
            // dd($array_of_images);
            // keep ratio height and width
            Image::make($single_image)->resize(null, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save();
    
            MultiPic::insert([
                // 'brand_name' => $request->brand_name.'.'.$single_image->extension(),
                'image' => $single_image->store($up_location, 'public'), //for this to work remember, run in terminal: php artisan storage:link //
                'created_at' => Carbon::now()
            ]);

        } //end foreach


        return redirect()->back()->with('success', 'Images Inserted Successfully');
    }
}
