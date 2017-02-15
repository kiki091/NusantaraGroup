<?php

namespace App\Model\Cms;

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
    public function scopeisPropertyId($query, $data = true)
    {
        return $query->where('property_location_id', $data);
    }
}
