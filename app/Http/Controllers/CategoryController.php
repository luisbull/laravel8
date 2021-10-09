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
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AllCat(){
        $categories = Category::latest()->paginate(5); // using Eloquent
        $trashCat = Category::onlyTrashed()->latest()->paginate(3); // using Eloquent
        
        // using Query Builder
        // $categories = DB::table('categories')
        //                 ->join('users', 'categories.user_id', 'users.id')
        //                 ->select('categories.*', 'users.name')
        //                 ->latest()->paginate(5); 
        // END using Query Builder
        
        return view('admin.category.index', compact('categories', 'trashCat'));
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

    public function Edit($id){
        // $categories = Category::find($id); // using Eloquent
        $categories = DB::table('categories')->where('id', $id)->first(); // using Query Builder

        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){
        // USING ELOQUENT //
        // $update = Category::find($id)->update([
            //     'category_name' => $request->category_name,
            //     'user_id' => Auth::user()->id
            // ]);
        // END USING ELOQUENT //
        
        // USING QUERY BUILDER //
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        // END USING QUERY BUILDER //

        return redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category Soft Deleted Successfully');
    }

    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category Restored Successfully');
    }

    public function PermanentDelete($id){
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category Permanetly Deleted');
    }

}
