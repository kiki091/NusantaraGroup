<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class StaticPageModel extends Model
{
    protected $table = 'static_page';
    public $timestamps = true;

    protected $fillable = [
	    'site_title',
        'logo_images',
        'site_name',
        'favicon_images' ,
        'og_title',
        'og_images',
        'og_description',
        'box_wrapper_left',
        'box_wrapper_center',
        'box_wrapper_right',
        'is_active',
        'property_location_id',
        'meta_title',
        'meta_keyword',
        'meta_description',
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
