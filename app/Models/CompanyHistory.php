<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyHistory extends Model
{
    protected $table = 'company_history';
    public $timestamps = true;


    protected $fillable = [
	    'title', 
	    'side_description',
	    'year', 
	    'description',
    ];

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }
}
