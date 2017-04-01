<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarierContent extends Model
{
    protected $table = 'carier_page';
    public $timestamps = true;


    protected $fillable = [
	    'introduction', 
	    'side_description',
	    'description'
    ];

}
