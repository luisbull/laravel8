<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use Illuminate\Routing\Route as RoutingRoute;
// use App\Models\User; //use for Eloquent

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
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

// This is FRONTEND route, include all DBs here in order to access dinamically //
Route::get('/', function () {
    // return view('welcome');
    $brands = DB::table('brands')->get(); // get all DB so can be @foreach in respective blade, this case home.blade.php
    $homeAbout = DB::table('home_abouts')->first(); // we use first to get just first entry from DB
    $services = DB::table('services')->get();
    $multi_images = DB::table('multi_pics')->get();
    $homeContact = DB::table('contacts')->first();
    // $projects = DB::table('projects')->get();
    return view('home', compact('brands','homeAbout','services','multi_images','homeContact'));
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

// Home Slider ALL routes //
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);
Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);
// END Home Slider ALL routes //

// Home About ALL routes //
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('/about/update/{id}', [AboutController::class, 'Update']);
Route::get('/about/delete/{id}', [AboutController::class, 'Delete']);
// END Home About ALL routes //

// Home Services ALL routes //
Route::get('/home/service', [ServiceController::class, 'HomeService'])->name('home.service');
Route::get('/add/service', [ServiceController::class,'AddService'])->name('add.service');
Route::post('/store/service', [ServiceController::class, 'StoreService'])->name('store.service');
Route::get('/service/edit/{id}', [ServiceController::class, 'Edit']);
Route::post('/service/update/{id}', [ServiceController::class, 'Update']);
Route::get('/service/delete/{id}', [ServiceController::class, 'Delete']);
// END Home Services ALL routes //

// Home Projects (PORTFOLIO) ALL routes //
// Route::get('home/pojects', [, ''])->name('home.projects');
// END Home Projects (PORTFOLIO) ALL routes //


// Potfolio ALL routes //
Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');
// END Potfolio ALL routes //

// Home Contact ALL routes //
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::get('/home/contact', [ContactController::class, 'HomeContact'])->name('home.contact');
Route::get('/add/contact', [ContactController::class, 'AddContact'])->name('add.contact');
Route::post('/store/contact', [ContactController::class, 'StoreContact'])->name('store.contact');
Route::get('/contact/edit/{id}', [ContactController::class, 'Edit']);
Route::post('/contact/update/{id}', [ContactController::class, 'Update']);
Route::get('/contact/delete/{id}', [ContactController::class, 'Delete']);
// END Home Contact ALL routes //

// Contact Message ALL routes //
Route::get('/message', [MessageController::class, 'Message'])->name('message');
Route::get('/home/message', [MessageController::class, 'ContactMessage'])->name('contact.message');
Route::get('/add/message', [MessageController::class, 'AddMessage'])->name('add.message');
Route::post('/store/message', [MessageController::class, 'StoreMessage'])->name('store.message');
Route::get('/message/edit/{id}', [MessageController::class, 'Edit']);
Route::post('/message/update/{id}', [MessageController::class, 'Update']);
Route::get('/message/delete/{id}', [MessageController::class, 'Delete']);
// END Contact Message ALL routes //
