<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class AwardsModel extends Model
{
    protected $table = 'company_award';
    public $timestamps = true;


    protected $fillable = [
	    'thumbnail', 
	    'images',
	    'office_name', 
	    'meta_title', 
	    'meta_keyword', 
	    'meta_description'
    ];

    public function translations()
    {
        return $this->hasMany('App\Models\Front\AwardsModelTrans', 'awards_id', 'id');
    }

    public function translation()
    {
        return $this->belongsTo('App\Models\Front\AwardsModelTrans', 'id', 'awards_id');
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
