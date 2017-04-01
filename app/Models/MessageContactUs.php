<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContactUs extends Model
{
    protected $table = 'contact_us';
    protected $fillable = ['firstname', 'lastname', 'email', 'subject', 'message'];
}
