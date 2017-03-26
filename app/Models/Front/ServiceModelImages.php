<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ServiceModelImages extends Model
{
    protected $table = 'service_images';
    public $timestamps = true;


    protected $fillable = [
	    'banner_images',
        'services_id'
    ];

}
