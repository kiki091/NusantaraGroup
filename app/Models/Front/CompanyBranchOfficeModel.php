<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyBranchOfficeModel extends Model
{
    protected $table = 'branch_office';
    public $timestamps = true;

    protected $fillable = [
        'slug',
	    'create_at', 
	    'create_by',
	    'update_at',
    ];

    public function translations()
    {
        return $this->hasMany('App\Models\Front\CompanyBranchOfficeModelTrans', 'branch_office_id', 'id');
    }

    public function translation()
    {
        return $this->belongsTo('App\Models\Front\CompanyBranchOfficeModelTrans', 'id', 'branch_office_id');
    }

    public function slider()
    {
        return $this->hasMany('App\Models\Front\CompanyBranchOfficeModelImages', 'office_id', 'id');
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
}
