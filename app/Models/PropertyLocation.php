<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyLocation
 */
class PropertyLocation extends Model
{
    protected $table = 'property_location';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'icon',
        'logo',
        'property_location_slug',
        'created_by',
        'updated_at'
    ];

    protected $guarded = [];

    /**
     * @param $query
     * @param $params
     * @return mixed
     */
    public function scopePropertyLocationSlug($query, $params)
    {
        return $query->where('property_location_slug', $params);
    }

}