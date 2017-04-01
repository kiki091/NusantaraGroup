<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us_page';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'subtitle', 'address', 'call_center', 'email', 'longitute', 'latitude', 'meta_keyword', 'meta_title', 'meta_description'];
    public $timestamp = true;
}
