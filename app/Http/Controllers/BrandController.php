<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5); // using Eloquent
        
        // using Query Builder
        // $brands = DB::table('brands')
        //                 ->join('users', 'brands.user_id', 'users.id')
        //                 ->select('brands.*', 'users.name')
        //                 ->latest()->paginate(5); 
        // END using Query Builder
        
        return view('admin.brand.index', compact('brands'));
    }

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
        $up_loacation = 'image/brand';  

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $brand_image->store($up_loacation, 'public'),
            // store('uploads', 'public')
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin/brand/edit', compact('brands')); 
    }

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

        $old_image = $request->brand_image;
        // 'storage/'.$brands->brand_image
        // Brand::find($id)->unlink($request->brand_name);
        File::delete($old_image);
        
        $brand_image = $request->file('brand_image');
        $up_loacation = 'image/brand';
        // $imagePath = public_path('storage/'.$post->image);
        // unlink($old_image);
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $brand_image->store($up_loacation, 'public'),
            // store('uploads', 'public')
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }
}
