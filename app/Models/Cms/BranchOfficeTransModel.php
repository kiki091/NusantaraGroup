<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class BranchOfficeTransModel extends Model
{
    protected $table = 'branch_office_trans';
    public $timestamps = true;

    protected $fillable = [
        'created_at',
        'created_by',
        'updated_at'
    ];

    public function translation()
    {
        return $this->belongsTo('App\Models\Front\CompanyBranchOfficeModel', 'branch_office_id', 'id');
    }

    /**
     * @param $query
     */
    public function scopeOfficeId($query, $params = true)
    {
        return $query->where('branch_office_id', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }

}
