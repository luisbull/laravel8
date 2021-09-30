<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5); // using Eloquent
        
        return view('admin.brand.index', compact('brands'));
    }

    ////////////
    // CREATE //
    ////////////
    public function StoreBrand(Request $request){
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,bmp,png,svg|max:1048',
            ],
            [
                'brand_name.required' => 'Please enter brand name', // here can be customised text instead of default message
                //  'brand_name.min' => 'Min 20' // here can be customised text instead of default message
            ], 
        );

        $brand_image = $request->file('brand_image');
        $up_location = 'image/brand';  

        // keep ratio height and width
        Image::make($brand_image)->resize(null, 200, function($constraint) {
            $constraint->aspectRatio();
        })->save();

        Brand::insert([
            'brand_name' => $request->brand_name.'.'.$brand_image->extension(),
            'brand_image' => $brand_image->store($up_location, 'public'), //for this to work remember, run in terminal: php artisan storage:link //
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }


    //////////
    // EDIT //
    //////////
    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin/brand/edit', compact('brands')); 
    }


    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id){
        $validated = $request->validate(
                    [
                        'brand_name' => 'required|min:4',
                        // 'brand_image' => 'required|mimes:jpg,jpeg,bmp,png,svg|max:1048',
                    ],
                    [
                        'brand_name.required' => 'Please enter brand name', // here can be customised text instead of default message
                        //  'brand_name.min' => 'Min 20' // here can be customised text instead of default message
                    ], 
                );


        $brand_image = $request->file('brand_image');
        $up_location = 'image/brand';

        $brand_entry = Brand::find($id);
        $old_image = public_path('storage/'.$brand_entry->brand_image);
        
        if($brand_image){
            if(File::exists($old_image)){
                File::delete($old_image);
                // dd('Si existe'); 
                Brand::find($id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $brand_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);
    
                return redirect()->back()->with('success', 'Brand Updated Successfully');    
            }else{
                Brand::find($id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $brand_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);

                return redirect()->back()->with('success', 'Brand Updated Successfully');
            }
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                // 'brand_image' => $brand_image->store($up_loacation, 'public'),
                // store('uploads', 'public')
                // 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');
        }
    }
    ////////////
    // DELETE //
    ////////////
    public function Delete($id){
        $brand_entry = Brand::find($id);
        $old_image = public_path('storage/'.$brand_entry->brand_image);

        File::delete($old_image);
        Brand::find($id)->delete();

        return redirect()->back()->with('success', 'Brande Deleted Successfully');
    }
}
