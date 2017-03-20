<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CarierContentModel extends Model
{
    protected $table = 'carier_page';
    public $timestamps = true;


    protected $fillable = [
	    'introduction', 
	    'side_description',
	    'description'
    ];

}
