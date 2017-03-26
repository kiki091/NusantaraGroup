<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyProfileModel extends Model
{
    protected $table = 'company_profile';
    public $timestamps = true;


    protected $fillable = [
	    'title', 
	    'side_description',
	    'description', 
        'images',
	    'meta_title', 
	    'meta_keyword', 
	    'meta_description'
    ];

}
