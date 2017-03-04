<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    protected $table = 'main_banner';
    protected $fillable = ['images', 'title', 'is_active'];

    /***************** Scope *****************/

    public function property_location()
    {
        return $this->hasMany('App\Model\PropertyLocation', 'id', 'property_location_id');
    }

    /**
     * @param $query
     */
    public function scopeIsActive($query, $data = true)
    {
        return $query->where('is_active', $data);
    }
}
