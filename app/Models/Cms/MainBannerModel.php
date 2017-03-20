<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class MainBannerModel extends Model
{
    protected $table = 'main_banner';
    public $timestamps = true;

    protected $fillable = [
        'images', 
        'title', 
        'is_active',
        'order',
        'created_at', 
        'created_by',
        'updated_at',
    ];

    /***************** Scope *****************/

    public function property_location()
    {
        return $this->hasMany('App\Models\PropertyLocation', 'id', 'property_location_id');
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
    public function scopeIsKey($query, $data = true)
    {
        return $query->where('banner_key', $data);
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
    public function scopeid($query, $id)
    {
        return $query->where('id', $id);
    }
}
