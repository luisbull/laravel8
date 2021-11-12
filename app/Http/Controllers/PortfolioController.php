<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AllImages(){
        $allImages = Portfolio::all();
        $categories_array = array("app","card","web");
        return view('admin.pics.index', compact('allImages', 'categories_array'));
    }

    public function StoreImages(Request $request){
        $validated = $request->validate(
            [
        //         'brand_name' => 'required|unique:brands|min:4',
                'image' => 'required',
                'portfolio_title' => 'required',
                'portfolio_category' => 'required',
            ],
            [
                // 'image.required' => 'POR AKI', // here can be customised text instead of default message
        //         //  'brand_name.min' => 'Min 20' // here can be customised text instead of default message
            ], 
        );

        

        $array_of_images = $request->file('image');
        $up_location = 'image/allpictures';  

        foreach($array_of_images as $single_image){
            // dd($array_of_images);
            // keep ratio height and width
            Image::make($single_image)->resize(null, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save();
    
            Portfolio::insert([
                // 'brand_name' => $request->brand_name.'.'.$single_image->extension(),
                'image' => $single_image->store($up_location, 'public'), //for this to work remember, run in terminal: php artisan storage:link //
                'category' => $request->portfolio_category,
                'title' => $request->portfolio_title,
                'created_at' => Carbon::now()
            ]);

        } //end foreach


        return redirect()->back()->with('success', 'Images Inserted Successfully');
    }
}
