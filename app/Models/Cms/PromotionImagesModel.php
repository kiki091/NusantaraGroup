<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class PromotionImagesModel extends Model
{
    protected $table = 'promotion_images';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

}
