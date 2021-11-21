<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use Illuminate\Routing\Route as RoutingRoute;
// use App\Models\User; //use for Eloquent

use App\Http\Controllers\BrandController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\UserProfileController;
use App\Models\Brand;
use Illuminate\Support\Facades\Artisan;
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
    $allImages = DB::table('portfolios')->get();
    $homeContact = DB::table('contacts')->first();
    // $projects = DB::table('projects')->get();
    return view('home', compact('brands','homeAbout','services','allImages','homeContact'));
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

// User PROFILE and PASSWORD change//
Route::get('/user/password', [UserPasswordController::class, 'ChangePassword'])->name('change.password');
Route::post('/password/update', [UserPasswordController::class, 'PasswordUpdate'])->name('password.update.dashboard');
Route::get('/user/profiled', [UserProfileController::class, 'ChangeProfile'])->name('change.profile');
Route::post('/profile/update', [UserProfileController::class, 'ProfileUpdate'])->name('profile.update.dashboard');
// END User PROFILE and PASSWORD change//


Route::prefix('/home')->group(function(){

    // Home Slider ALL routes //
    Route::get('/slider', [SliderController::class, 'HomeSlider'])->name('home.slider');
    Route::get('/add/slider', [SliderController::class, 'AddSlider'])->name('add.slider');
    Route::post('/store/slider',[SliderController::class, 'StoreSlider'])->name('store.slider');
    Route::get('/slider/edit/{id}', [SliderController::class, 'Edit'])->name('slider.edit');
    Route::post('/slider/update/{id}', [SliderController::class, 'Update'])->name('slider.update');
    Route::get('/slider/delete/{id}', [SliderController::class, 'Delete'])->name('slider.delete');
    // END Home Slider ALL routes //
    
    // Home About ALL routes //
    Route::get('/about', [AboutController::class, 'HomeAbout'])->name('home.about');
    Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
    Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
    Route::get('/about/edit/{id}', [AboutController::class, 'Edit'])->name('about.edit');
    Route::post('/about/update/{id}', [AboutController::class, 'Update'])->name('about.update');
    Route::get('/about/delete/{id}', [AboutController::class, 'Delete'])->name('about.delete');
    // END Home About ALL routes //
    
    // Home Services ALL routes //
    Route::get('/service', [ServiceController::class, 'HomeService'])->name('home.service');
    Route::get('/add/service', [ServiceController::class,'AddService'])->name('add.service');
    Route::post('/store/service', [ServiceController::class, 'StoreService'])->name('store.service');
    Route::get('/service/edit/{id}', [ServiceController::class, 'Edit'])->name('service.edit');
    Route::post('/service/update/{id}', [ServiceController::class, 'Update'])->name('service.update');
    Route::get('/service/delete/{id}', [ServiceController::class, 'Delete'])->name('service.delete');
    // END Home Services ALL routes //
    
    // Home Projects (PORTFOLIO) ALL routes //
    // Route::get('home/pojects', [, ''])->name('home.projects');
    // END Home Projects (PORTFOLIO) ALL routes //
    
    
    // Potfolio ALL routes //
    Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');
    Route::get('/portfolio/all', [PortfolioController::class, 'AllImages'])->name('all.multiImage');
    Route::post('/portfolio/store', [PortfolioController::class, 'StoreImages'])->name('store.images');
    Route::get('/portfolio/edit/{id}', [PortfolioController::class, 'Edit'])->name('portfolio.edit');
    Route::post('/portfolio/update/{id}', [PortfolioController::class, 'Update'])->name('portfolio.update');
    Route::get('/portfolio/delete/{id}', [PortfolioController::class, 'Delete'])->name('portfolio.delete');
    // END Potfolio ALL routes //
    
    // Brand controller //
    Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
    Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'Edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'Update'])->name('brand.update');
    Route::get('/brand/delete/{id}', [BrandController::class, 'Delete'])->name('brand.delete');
    // END Brand controller //
    
    // Home Contact ALL routes //
    Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
    Route::get('/contact/all', [ContactController::class, 'HomeContact'])->name('home.contact');
    Route::get('/add/contact', [ContactController::class, 'AddContact'])->name('add.contact');
    Route::post('/store/contact', [ContactController::class, 'StoreContact'])->name('store.contact');
    Route::get('/contact/edit/{id}', [ContactController::class, 'Edit'])->name('contact.edit');
    Route::post('/contact/update/{id}', [ContactController::class, 'Update'])->name('contact.update');
    Route::get('/contact/delete/{id}', [ContactController::class, 'Delete'])->name('contact.delete');
    // END Home Contact ALL routes //

});




// Contact Message ALL routes //
Route::prefix('/contactmessages')->group(function(){

    Route::get('/message', [MessageController::class, 'Message'])->name('message');
    Route::get('/message/all', [MessageController::class, 'ContactMessage'])->name('contact.message');
    Route::get('/add/message', [MessageController::class, 'AddMessage'])->name('add.message');
    Route::post('/store/message', [MessageController::class, 'StoreMessage'])->name('store.message');
    Route::get('/message/edit/{id}', [MessageController::class, 'Edit'])->name('message.edit');
    Route::post('/message/update/{id}', [MessageController::class, 'Update'])->name('message.update');
    Route::get('/message/delete/{id}', [MessageController::class, 'Delete'])->name('message.delete');

});
// END Contact Message ALL routes //

Route::get('/storage', function(){
 Artisan::call('storage:link');
});
