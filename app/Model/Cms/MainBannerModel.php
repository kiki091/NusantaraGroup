<?php

namespace App\Model\Cms;

use Illuminate\Database\Eloquent\Model;

class MainBannerModel extends Model
{
    protected $table = 'main_banner';
    protected $fillable = ['images', 'title', 'is_active'];

    /***************** Scope *****************/

    public function property_location()
    {
        return $this->hasMany('App\Model\PropertyLocation', 'id', 'property_location_id');
    }

    /**
     * @param $query
     */
    public function scopeIsActive($query, $data = true)
    {
        return $query->where('is_active', $data);
    }

    /**
     * @param $query
     */
    public function scopePropertyId($query, $data)
    {
        return $query->where('property_location_id', $data);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
