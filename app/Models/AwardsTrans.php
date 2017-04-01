<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardsTrans extends Model
{
    protected $table = 'company_award_trans';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

}
