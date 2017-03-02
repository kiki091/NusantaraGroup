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

    public function translations()
    {
        return $this->hasMany('App\Model\Cms\BranchOfficeModel', 'id', 'office_id');
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
