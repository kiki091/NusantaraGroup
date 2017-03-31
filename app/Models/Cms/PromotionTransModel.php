<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class PromotionTransModel extends Model
{
    protected $table = 'promotion_trans';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

}
