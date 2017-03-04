<?php

namespace App\Model\Cms;

use Illuminate\Database\Eloquent\Model;

class BookingServicesModel extends Model
{
    protected $table = 'booking_services';
    public $timestamps = true;

    protected $fillable = [
        'no_booking',
        'created_at',
        'updated_at'
    ];

    /***************** Scope *****************/

    public function property_location()
    {
        return $this->hasMany('App\Model\PropertyLocation', 'id', 'property_location_id');
    }

    public function branch_office()
    {
        return $this->belongsTo('App\Model\Front\CompanyBranchOfficeModel', 'branch_office_id', 'id');
    }

    /**
     * @param $query
     */
    public function scopeIsStatus($query, $data = true)
    {
        return $query->where('status', $data);
    }

    /**
     * @param $query
     */
    public function scopePropertyId($query, $data)
    {
        return $query->where('property_location_id', $data);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
