<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class BookingServicesModel extends Model
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
}