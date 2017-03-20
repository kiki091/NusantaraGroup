<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class MessageContactUsModel extends Model
{
    protected $table = 'contact_us';
    protected $fillable = ['firstname', 'lastname', 'email', 'subject', 'message'];
}
