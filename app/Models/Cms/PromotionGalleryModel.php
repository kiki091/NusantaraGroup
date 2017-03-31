<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class PromotionGalleryModel extends Model
{
    protected $table = 'promotion_gallery';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

}
