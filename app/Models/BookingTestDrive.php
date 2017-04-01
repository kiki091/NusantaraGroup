<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTestDrive extends Model
{
	protected $table = 'booking_test_drive';
    public $timestamps = true;


    protected $fillable = [
    	'no_booking',
	    'jenis_kendaraan',
	    'nama_lengkap', 
	    'no_telpon', 
	    'email', 
	    'tanggal_booking',
	    'keterangan',
    ];
}