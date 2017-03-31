<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class PromotionDatailModel extends Model
{
    protected $table = 'promotion_detail';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

}
