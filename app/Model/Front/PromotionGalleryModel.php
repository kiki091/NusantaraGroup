<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class PromotionGalleryModel extends Model
{
    protected $table = 'promotion_gallery';
    public $timestamps = true;


    protected $fillable = [
	    'filename', 
	    'promotion_id',
	    'created_at',
	    'updated_at'
    ];

}