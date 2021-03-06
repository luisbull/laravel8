<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];

    // using Aloquent - relating two tables (Categories and User) to use User-name instead of User-id 
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
