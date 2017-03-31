<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class PromotionCategoryModel extends Model
{
    protected $table = 'promotion_category';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

    public function translation()
    {
        return $this->hasMany('App\Models\Cms\PromotionModel', 'promotion_category_id', 'id');
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
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
