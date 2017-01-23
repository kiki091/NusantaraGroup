<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    public $timestamps = true;


    protected $fillable = [
	    'title', 
        'slug',
	    'images',
	    'side_description', 
        'description',
        'service_category_id',
	    'meta_title', 
	    'meta_keyword', 
	    'meta_description'
    ];

    public function translations()
    {
        return $this->hasMany('App\Model\Front\ServiceModelCategory', 'id', 'service_category_id');
    }

    public function translation()
    {
        return $this->belongsTo('App\Model\Front\ServiceModelCategory', 'service_category_id', 'id');
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

    public function scopeServicesCategoryId($query, $params = true)
    {
        return $query->where('service_category_id', $params);
    }
}
