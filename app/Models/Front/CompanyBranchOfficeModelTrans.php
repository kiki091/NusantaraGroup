<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyBranchOfficeModelTrans extends Model
{
    protected $table = 'branch_office_trans';
    
    protected $fillable = [
	    'title_description', 
	    'address',
        'branch_office_id'
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopebranchOfficeId($query, $params = true)
    {
        return $query->where('branch_office_id', $params);
    }
}
