<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarierDetail extends Model
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
        return $this->belongsTo('App\Models\Carier', 'carier_category_id', 'id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}
