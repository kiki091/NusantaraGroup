<?php

namespace App\Model\Cms;

use Illuminate\Database\Eloquent\Model;

class AwardsModel extends Model
{
    protected $table = 'company_award';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'created_by',
	    'updated_at',
    ];

    public function property_location()
    {
        return $this->hasMany('App\Model\PropertyLocation', 'id', 'property_location_id');
    }

    public function translation()
    {
        return $this->hasMany('App\Model\Cms\AwardsTransModel', 'awards_id', 'id');
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
    public function scopeid($query, $id)
    {
        return $query->where('id', $id);
    }
}
