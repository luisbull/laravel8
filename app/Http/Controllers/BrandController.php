<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        $up_loacation = 'image/brand';
        // $last_img = $up_loacation.$img_name;

        // $brand_image->move($up_loacation, $img_name);
        // $brand_image->move($up_loacation, $img_name);
        

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $brand_image->store($up_loacation, 'public'),
            // store('uploads', 'public')
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand Inserted Successfully');

    }
}
