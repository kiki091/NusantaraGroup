<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyHistoryImageModel extends Model
{
    protected $table = 'company_history_image';
    public $timestamps = true;


    protected $fillable = [
	    'filename'
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
