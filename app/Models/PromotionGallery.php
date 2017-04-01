<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionGallery extends Model
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