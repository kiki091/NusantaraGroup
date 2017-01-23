<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    protected $table = 'main_banner';
    protected $fillable = ['images', 'title', 'is_active'];

    protected $guarded = [];
}
