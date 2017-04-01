<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    protected $table = 'company_award';
    public $timestamps = true;


    protected $fillable = [
	    'thumbnail', 
	    'images',
	    'office_name', 
	    'meta_title', 
	    'meta_keyword', 
	    'meta_description'
    ];

    public function property_location()
    {
        return $this->hasMany('App\Models\PropertyLocation', 'id', 'property_location_id');
    }

    public function translations()
    {
        return $this->belongsTo('App\Models\AwardsTrans', 'id', 'awards_id');
    }

    public function translation()
    {
        return $this->hasMany('App\Models\AwardsTrans', 'awards_id', 'id');
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
