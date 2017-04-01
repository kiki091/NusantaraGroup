<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionTrans extends Model
{
    protected $table = 'promotion_trans';
    public $timestamps = true;


    protected $fillable = [
	    'created_at', 
	    'updated_at',
	    'promotion_id'
    ];

}