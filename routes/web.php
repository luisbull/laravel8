<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// use App\Models\User; //use for Eloquent

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all(); // using Eloquent
    $users = DB::table('users')->get(); // using Query Builder

    return view('dashboard', compact('users'));
})->name('dashboard');
