<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionCategory extends Model
{
    protected $table = 'promotion_category';
    public $timestamps = true;


    protected $fillable = [
	    'thumbnail', 
	    'category_name', 
	    'category_slug',
        'created_at', 
	    'updated_at'
    ];

    public function translations()
    {
        return $this->hasMany('App\Models\Promotion', 'promotion_category_id', 'id');
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
    public function scopeSlug($query, $params = true)
    {
        return $query->where('category_slug', $params);
    }
}