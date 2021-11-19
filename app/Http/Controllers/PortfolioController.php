<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function AllImages(){
        $allImages = Portfolio::all();
        $categories_array = array("app","card","web");
        return view('admin.pics.index', compact('allImages', 'categories_array'));
    }

    ////////////
    // CREATE //
    ////////////
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

    //////////
    // EDIT //
    //////////

    public function Edit($id){
        $portfolio = Portfolio::find($id);
        $categories_array = array("app","card","web");
        $categories_array = array_diff($categories_array, array($portfolio->category));
        return view('admin.pics.edit', compact('portfolio', 'categories_array'));
    }


    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validated = $request->validate(
            [
                'portfolio_title' => 'required|min:4',
                'portfolio_category' => 'required',
                // 'portfolio_image' => 'required|mimes:jpg,jpeg,bmp,png,svg|max:1048',
            ],
            [
                'portfolio_title.required' => 'Please enter portfolio title', // here can be customised text instead of default message
                //  'title.min' => 'Min 20' // here can be customised text instead of default message
                // 'portfolio_category.required' => 'necesitas las descripcion'
                //  'image.mimes' => 'Only jpg,jpeg,bmp,png,svg accepted' // here can be customised text instead of default message
            ], 
        );

        $portfolio_image = $request->file('portfolio_image');
        
        $up_location = 'image/allpictures';
        
        $portfolio_entry = Portfolio::find($id);
        $old_image = public_path('storage/'.$portfolio_entry->image);
        
        if($portfolio_image){
            if(File::exists($old_image)){
                File::delete($old_image);
                
                Portfolio::find($id)->update([
                    'title' => $request->portfolio_title,
                    'category' => $request->portfolio_category,
                    'image' => $portfolio_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);
    
                return redirect()->back()->with('success', 'Slider Updated Successfully');    
            
            }else{
                Portfolio::find($id)->update([
                    'title' => $request->portfolio_title,
                    'category' => $request->portfolio_category,
                    'image' => $portfolio_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);

                return redirect()->back()->with('success', 'Slider Updated Successfully');
            }
        }else{
            Portfolio::find($id)->update([
                'title' => $request->portfolio_title,
                'category' => $request->portfolio_category,
                // 'image' => $brand_image->store($up_loacation, 'public'),
                // store('uploads', 'public')
                // 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Category Updated Successfully');
        }
    }


    ///////////////////
    // FRONTEND PAGE //
    ///////////////////
    public function Portfolio(){
        $allImages = Portfolio::all();
        $categories_array = array("app","card","web");
        return view('layouts.pages.portfolio', compact('allImages', 'categories_array'));
    }

}
