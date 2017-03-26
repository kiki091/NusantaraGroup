<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class LandingModel extends Model
{
    protected $table = 'static_page';
    protected $fillable = ['site_title', 'logo_images', 'site_name', 'favicon_images', 'og_title', 'og_images', 'og_description', 'meta_title', 'meta_keyword', 'meta_description', 'is_active'];
}
