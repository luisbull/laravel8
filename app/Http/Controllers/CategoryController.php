<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){
        // $categories = Category::latest()->get(); // using Eloquent
        $categories = DB::table('categories')->latest()->get(); // using Query Builder
        return view('admin.category.index', compact('categories'));
    }

    public function AddCat(Request $request){
        $validated = $request->validate(
            ['category_name' => 'required|unique:categories|max:255',],
            ['category_name.required' => 'Please enter category name', // here can be customised instead of default message
            //  'category_name.max' => 'Max 20'
            ], 
        );

        // USING ELOQUENT //
        // // ONE way to add category //
        Category::insert([
                'category_name' => $request->category_name,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);
        // // END ONE way to add category //

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();
        // END USING ELOQUENT //

        // // USING QUERY BUILDER //
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // $data['created_at'] = Carbon::now();
        // DB::table('categories')->insert($data);
        // // END USING QUERY BUILDER //

        return redirect()->back()->with('success', 'Category Inserted Successfully');

    }
}
