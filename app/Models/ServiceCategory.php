<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_category';
    public $timestamps = true;


    protected $fillable = [
        'id',
	    'name',
        'slug'
    ];

    public function category()
    {
        return $this->hasMany('App\Models\Service', 'service_category_id', 'id');
    }

    public function property_location()
    {
        return $this->hasMany('App\Models\PropertyLocation', 'id', 'property_location_id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopePropertyId($query, $params)
    {
        return $query->where('property_location_id', $params);
    }

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
    public function scopeSlug($query, $params)
    {
        return $query->where('slug', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
