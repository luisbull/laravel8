<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
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
    public function AllImages()
    {
        $allImages = Portfolio::all();
        $categories = PortfolioCategory::all();

        return view('admin.portfolio.index', compact('allImages', 'categories'));
    }


    ////////////
    // CREATE //
    ////////////
    public function StoreImages(Request $request)
    {

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

        foreach ($array_of_images as $single_image) {
            // keep ratio height and width
            Image::make($single_image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save();

            Portfolio::insert([
                // 'brand_name' => $request->brand_name.'.'.$single_image->extension(),
                'image' => $single_image->store($up_location, 'public'), //for this to work remember, run in terminal: php artisan storage:link //
                'cat_id' => (int)$request->portfolio_category,
                'cat_name' => PortfolioCategory::find($request->portfolio_category)->name,
                'title' => $request->portfolio_title,
                'created_at' => Carbon::now()
            ]);
        } //end foreach

        return redirect()->back()->with('success', 'Images Inserted Successfully');
    }


    //////////
    // EDIT //
    //////////
    public function Edit($id)
    {
        $portfolio = Portfolio::find($id);
        $categories = PortfolioCategory::all();
        // $categories = array_diff(array($categories), array($portfolio->category));
        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }


    ////////////
    // UPDATE //
    ////////////
    public function Update(Request $request, $id)
    {

        $validated = $request->validate(
            [
                'portfolio_title' => 'required|min:4',
                // 'portfolio_category' => 'required',
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
        $old_image = public_path('storage/' . $portfolio_entry->image);


        if ($portfolio_image) {
            if (File::exists($old_image)) {
                File::delete($old_image);

                Portfolio::find($id)->update([
                    'title' => $request->portfolio_title,
                    'cat_id' => $request->portfolio_category,
                    'cat_name' => PortfolioCategory::find($request->portfolio_category)->name,
                    'image' => $portfolio_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);

                return redirect()->back()->with('success', 'Slider Updated Successfully');
            } else {
                Portfolio::find($id)->update([
                    'title' => $request->portfolio_title,
                    'cat_id' => $request->portfolio_category,
                    'cat_name' => PortfolioCategory::find($request->portfolio_category)->name,
                    'image' => $portfolio_image->store($up_location, 'public'),
                    // store('uploads', 'public')
                    'updated_at' => Carbon::now()
                ]);

                return redirect()->back()->with('success', 'Slider Updated Successfully');
            }
        } else {

            Portfolio::find($id)->update([
                'title' => $request->portfolio_title,
                'cat_id' => $request->portfolio_category,
                'cat_name' => PortfolioCategory::find($request->portfolio_category)->name,
                // 'image' => $brand_image->store($up_loacation, 'public'),
                // store('uploads', 'public')
                // 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Slider Updated Successfully');
        }
    }


    ////////////
    // DELETE //
    ////////////
    public function Delete($id)
    {
        $portfolio_entry = Portfolio::find($id);
        $old_image = public_path('storage/' . $portfolio_entry->image);

        File::delete($old_image);
        Portfolio::find($id)->delete();

        return redirect()->back()->with('success', 'Project Deleted Successfully');
    }


    ///////////////////
    // FRONTEND PAGE //
    ///////////////////
    public function Portfolio()
    {
        $allImages = Portfolio::all();
        $categories = PortfolioCategory::all();
        return view('layouts.pages.portfolio', compact('allImages', 'categories'));
    }


    //////////////////
    // ADD CATEGORY //
    //////////////////
    public function AddCategory()
    {
        $allImages = Portfolio::all();
        $categories = PortfolioCategory::all();

        return view('admin.portfolio.addCategory');
    }


    ////////////////////
    // STORE CATEGORY //
    ////////////////////
    public function StoreCategory(Request $request)
    {
        $validated = $request->validate(
            [
                'portfolio_category' => 'required|min:2',
            ],
        );

        PortfolioCategory::insert([
            'name' => $request->portfolio_category,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('all.multiImage')->with('success', 'Category Created Successfully');
    }


    ///////////////////
    // EDIT CATEGORY //
    ///////////////////
    public function EditCategory($id)
    {
        // $portfolio = Portfolio::find($id);
        $categories = PortfolioCategory::find($id);
        // $categories = PortfolioCategory::all();
        // $categories = array_diff(array($categories), array($portfolio->category));
        return view('admin.portfolio.editCategory', compact('categories'));
    }


    /////////////////////
    // UPDATE CATEGORY //
    /////////////////////
    public function UpdateCategory(Request $request, $id)
    {
        try {
            $validated = $request->validate(
                [
                    'portfolio_category' => 'required|min:2',
                ]
            );
    
            PortfolioCategory::find($id)->update([
                'name' => $request->portfolio_category,
                'updated_at' => Carbon::now()
            ]);
            Portfolio::where('cat_id', $id)->update([
                'cat_name' => $request->portfolio_category
            ]);
            // $users = Portfolio::where('cat_id', $id)->get();
    
            return redirect()->route('all.multiImage')->with('success', 'Category Updated Successfully');

        } catch(\Illuminate\Database\QueryException $ex) {
            return redirect()->route('all.multiImage')->with('error', 'Project category '. $request->portfolio_category . ' already exits. Please use different name');
        }
        
    }


    ////////////
    // DELETE //
    ////////////
    public function DeleteCategory($id)
    {
        $category  = PortfolioCategory::find($id);
        // dd($category);
        try {
            PortfolioCategory::find($id)->delete();
            return redirect()->back()->with('success', 'Project Category Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Project category '. $category->name . ' can\'t be Deleted. There are projects assigned to this category');
        }
    }

}
