<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class PromotionModel extends Model
{
    protected $table = 'promotion';
    public $timestamps = true;


    protected $fillable = [
	    'title', 
	    'slug', 
	    'promotion_category_id', 
	    'created_at', 
	    'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Front\PromotionCategoryModel', 'promotion_category_id', 'id');
    }

    public function translation()
    {
        return $this->hasMany('App\Models\Front\PromotionTransModel', 'promotion_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Front\PromotionImageModel', 'promotion_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Front\PromotionDetailModel', 'promotion_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Models\Front\PromotionGalleryModel', 'promotion_id', 'id');
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