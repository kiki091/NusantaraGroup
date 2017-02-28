<?php

namespace App\Model\Cms;

use Illuminate\Database\Eloquent\Model;

class BranchOfficeImagesModel extends Model
{
    protected $table = 'branch_office_images';
    public $timestamps = true;

    protected $fillable = [
        'created_at',
        'created_by',
        'updated_at'
    ];

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('office_id', $params);
    }

}
