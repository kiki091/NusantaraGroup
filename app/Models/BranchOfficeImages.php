<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchOfficeImages extends Model
{
    protected $table = 'branch_office_images';
    public $timestamps = true;

    protected $fillable = [
        'created_at',
        'created_by',
        'updated_at'
    ];

    public function translations()
    {
        return $this->belongsTo('App\Models\BranchOffice', 'id', 'office_id');
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }

    public function scopeIsOffice($query, $params = true)
    {
        return $query->where('office_id', $params);
    }

}
