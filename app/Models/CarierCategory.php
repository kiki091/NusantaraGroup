<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarierCategory extends Model
{
    protected $table = 'carier_category';
    public $timestamps = true;


    protected $fillable = [
	    'category_name', 
	    'thumbnail'
    ];

    
}
