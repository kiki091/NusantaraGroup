<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class BranchOfficeModel extends Model
{
    protected $table = 'branch_office';
    public $timestamps = true;

    protected $fillable = [
        'slug',
        'order',
	    'created_at', 
	    'created_by',
	    'updated_at',
    ];

    public function branch_office()
    {
        return $this->hasMany('App\Models\Cms\BranchOfficeTransModel', 'branch_office_id', 'id');
    }

    public function property_location()
    {
        return $this->hasMany('App\Models\PropertyLocation', 'id', 'property_location_id');
    }

    public function translation()
    {
        return $this->belongsTo('App\Models\Cms\BranchOfficeTransModel', 'id', 'branch_office_id');
    }

    public function slider()
    {
        return $this->hasMany('App\Models\Cms\BranchOfficeImagesModel', 'office_id', 'id');
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
