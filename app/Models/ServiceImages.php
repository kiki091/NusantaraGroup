<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImages extends Model
{
    protected $table = 'service_images';
    public $timestamps = true;


    protected $fillable = [
	    'banner_images',
        'services_id'
    ];

}
