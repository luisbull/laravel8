<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\MultiPic;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /////////////////////
    // READ (load ALL) //
    /////////////////////
    public function Portfolio(){
        $allImages = MultiPic::all();
        return view('layouts.pages.portfolio', compact('allImages'));
    }
}
