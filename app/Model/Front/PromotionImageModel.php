<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class PromotionImageModel extends Model
{
    protected $table = 'promotion_images';
    public $timestamps = true;


    protected $fillable = [
	    'banner_image', 
	    'interior_image',
	    'exterior_image', 
	    'safety_image', 
	    'accesories_image', 
	    'promotion_id',
	    'created_at',
	    'updated_at'
    ];

}