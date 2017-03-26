<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CarierCategoryModel extends Model
{
    protected $table = 'carier_category';
    public $timestamps = true;


    protected $fillable = [
	    'category_name', 
	    'thumbnail'
    ];

    
}
