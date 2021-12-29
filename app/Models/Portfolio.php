<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'cat_id',
        'cat_name',
        'title',
    ];

    // public function category(){
    //     return $this->belongsTo('App/Models/PorfolioCategory');
    // }
}
