<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
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
        return $this->belongsTo('App\Models\PromotionCategory', 'promotion_category_id', 'id');
    }

    public function translation()
    {
        return $this->hasMany('App\Models\PromotionTrans', 'promotion_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\PromotionImage', 'promotion_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\PromotionDetail', 'promotion_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Models\PromotionGallery', 'promotion_id', 'id');
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

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}