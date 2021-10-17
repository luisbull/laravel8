<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use Illuminate\Routing\Route as RoutingRoute;
// use App\Models\User; //use for Eloquent

use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\UserController;
use App\Models\Brand;
use Illuminate\Support\Facades\DB; // use for Query Builder

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    // return view('welcome');
    $brands = DB::table('brands')->get();
    return view('home', compact('brands'));
});

Route::get('/home', function () {
    // return view('welcome');
    echo 'This home page';
});

Route::get('/about', function (){
    return view('about');
// })->middleware('age');
});


// For Laravel 6 7 //
// Route::get('/contact', 'ContactController@index');
// END For Laravel 6 7 //

Route::get('/contact-PAPA-RAPA', [ContactController::class, 'index'])->name('conX');

// Category controller //
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PermanentDelete']);
// END Category controller //

// Brand controller //
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);
// END Brand controller //

// MultiImage controller //
Route::get('/multiImage/all', [MultiImageController::class, 'AllImages'])->name('all.multiImage');
Route::post('/multiImage/store', [MultiImageController::class, 'StoreImages'])->name('store.images');
// END MultiImage controller //




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all(); // using Eloquent
    // $users = DB::table('users')->get(); // using Query Builder

    // return view('dashboard', compact('users'));
    return view('admin.index');
})->name('dashboard');

// User LOGOUT //
Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');
// Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');
// END User LOGOUT //

// Admin ALL routes //
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);
Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);
// END Admin ALL routes //

// Home About ALL routes //
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
// END Home About ALL routes //