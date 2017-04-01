<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingServices extends Model
{
    protected $table = 'booking_services';
    public $timestamps = true;

    protected $fillable = [
        'no_booking',
        'no_kendaraan', 
        'jenis_kendaraan',
        'nama_lengkap', 
        'no_telpon', 
        'email', 
        'tanggal_booking',
        'keterangan',
        'branch_office_id'
    ];

    /***************** Scope *****************/

    public function property_location()
    {
        return $this->hasMany('App\Models\PropertyLocation', 'id', 'property_location_id');
    }

    public function branch_office()
    {
        return $this->belongsTo('App\Models\BranchOffice', 'branch_office_id', 'id');
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
