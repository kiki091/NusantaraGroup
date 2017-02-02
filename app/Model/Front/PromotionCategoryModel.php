<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class PromotionCategoryModel extends Model
{
    protected $table = 'promotion_category';
    public $timestamps = true;


    protected $fillable = [
	    'thumbnail', 
	    'category_name', 
	    'category_slug',
        'created_at', 
	    'updated_at'
    ];
}