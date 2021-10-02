<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use Illuminate\Routing\Route as RoutingRoute;
// use App\Models\User; //use for Eloquent

use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiImageController;
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

Route::get('/', function () {
    return view('welcome');
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
    $users = DB::table('users')->get(); // using Query Builder

    return view('dashboard', compact('users'));
})->name('dashboard');
