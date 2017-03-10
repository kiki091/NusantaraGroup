<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class SubscribeModel extends Model
{
    protected $table = 'subscribe';
    protected $fillable = ['email'];
}
