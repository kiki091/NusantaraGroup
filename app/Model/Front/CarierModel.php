<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class CarierModel extends Model
{
    protected $table = 'carier';
    public $timestamps = true;


    protected $fillable = [
	    'job_title', 
	    'slug',
	    'job_description', 
	    'carier_category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Front\CarierCategoryModel', 'carier_category_id', 'id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }
}
