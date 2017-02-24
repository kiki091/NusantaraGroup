<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class PromotionDetailModel extends Model
{
    protected $table = 'promotion_detail';
    public $timestamps = true;


    protected $fillable = [
	    'equipment', 
	    'equipment_interior',
	    'equipment_exterior', 
	    'information', 
	    'promotion_id',
	    'created_at',
	    'updated_at'
    ];

}