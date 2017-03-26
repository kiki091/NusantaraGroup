<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyHistoryModel extends Model
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
