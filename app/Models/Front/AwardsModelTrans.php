<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class AwardsModelTrans extends Model
{
    protected $table = 'company_award_trans';
    public $timestamps = true;


    protected $fillable = [
	    'awards_id', 
	    'description'
    ];

    
}
