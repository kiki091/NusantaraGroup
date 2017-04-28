<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carier extends Model
{
    protected $table = 'carier_category';
    public $timestamps = true;


    protected $fillable = [
	    'category_name', 
	    'thumbnail'
    ];

    public function detail()
    {
        return $this->hasMany('App\Models\CarierDetail', 'id', 'carier_category_id');
    }

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
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
