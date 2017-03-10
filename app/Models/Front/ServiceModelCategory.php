<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ServiceModelCategory extends Model
{
    protected $table = 'service_category';
    public $timestamps = true;


    protected $fillable = [
	    'name',
        'slug'
    ];

    public function category()
    {
        return $this->hasMany('App\Models\Front\ServiceModel', 'service_category_id', 'id');
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
    public function scopeSlug($query, $params = true)
    {
        return $query->where('slug', $params);
    }
}
