<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class PromotionModel extends Model
{
    protected $table = 'promotion';
    public $timestamps = true;

    protected $fillable = [
	    'created_at', 
	    'updated_at',
    ];

    public function translation()
    {
        return $this->hasMany('App\Models\Cms\PromotionTransModel', 'promotion_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Cms\PromotionImagesModel', 'promotion_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Models\Cms\PromotionGalleryModel', 'promotion_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Cms\PromotionDatailModel', 'promotion_id', 'id');
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
