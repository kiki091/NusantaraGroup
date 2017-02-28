<?php

namespace App\Model\Cms;

use Illuminate\Database\Eloquent\Model;

class BranchOfficeModel extends Model
{
    protected $table = 'branch_office';
    public $timestamps = true;

    protected $fillable = [
        'slug',
	    'create_at', 
	    'create_by',
	    'update_at',
    ];

    public function property_location()
    {
        return $this->hasMany('App\Model\PropertyLocation', 'id', 'property_location_id');
    }

    public function translation()
    {
        return $this->belongsTo('App\Model\Cms\BranchOfficeTransModel', 'branch_office_id', 'id');
    }

    public function slider()
    {
        return $this->hasMany('App\Model\Front\CompanyBranchOfficeModelImages', 'office_id', 'id');
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
