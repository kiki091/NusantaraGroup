<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class PromotionModel extends Model
{
    protected $table = 'promotion';
    public $timestamps = true;


    protected $fillable = [
	    'title', 
	    'slug',
	    'thumbnail', 
	    'promotion_category_id', 
	    'created_at', 
	    'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Front\PromotionCategoryModel', 'promotion_category_id', 'id');
    }

    public function images()
    {
        return $this->belongsTo('App\Model\Front\PromotionImageModel', 'promotion_id', 'id');
    }


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }
}