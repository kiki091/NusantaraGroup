<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public $timestamp = true;

    protected $fillable = [
	    'title', 
	    'side_description', 
	    'quote_description', 
	    'description', 
	    'thumbnail', 
	    'meta_keyword', 
	    'meta_title', 
	    'meta_description'
    ];

    /**
     * Relation With Image Slider
     */

    public function images_detail()
    {
        return $this->hasMany('App\Models\NewsImages', 'news_id', 'id');
    }

    /**
     * Relation With Property Location
     */

    public function property_location()
    {
        return $this->belongsTo('App\Models\PropertyLocation', 'property_location_id', 'id');
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
    public function scopeSlug($query, $params = true)
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
