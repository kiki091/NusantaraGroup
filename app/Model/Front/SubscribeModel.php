<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class SubscribeModel extends Model
{
    protected $table = 'subscribe';
    protected $fillable = ['email'];
}
