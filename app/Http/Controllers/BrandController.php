<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
                'brand_image' => 'required|mimes:jpg, jpeg, png, svg, bpm|max:1048',
            ],
            [
                'brand_name.required' => 'Please enter brand name', // here can be customised text instead of default message
                //  'brand_name.min' => 'Min 20' // here can be customised text instead of default message
            ], 
        );

        $brand_image = $request->file('brand_image');
    }
}
