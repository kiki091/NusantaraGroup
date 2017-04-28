<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        return $this->hasMany('App\Models\ServiceCategory', 'id', 'service_category_id');
    }

    public function translation()
    {
        return $this->belongsTo('App\Models\ServiceCategory', 'service_category_id', 'id');
    }

    public function banner()
    {
        return $this->hasMany('App\Models\ServiceImages', 'services_id', 'id');
    }

    public function category()
    {
        return $this->hasMany('App\Models\ServiceCategory', 'id', 'services_id');
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

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
