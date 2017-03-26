<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyBranchOfficeModelImages extends Model
{
    protected $table = 'branch_office_images';
    
    protected $fillable = [
	    'images',
        'office_id'
    ];

    protected $guarded = [];
}
