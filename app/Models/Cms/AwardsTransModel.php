<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class AwardsTransModel extends Model
{
    protected $table = 'company_award_trans';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

}
