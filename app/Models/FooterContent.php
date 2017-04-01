<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterContent extends Model
{
    protected $table = 'footer_page';
    protected $fillable = ['footer_box_center', 'footer_box_right', 'facebook_link', 'instagram_link', 'tweeter_link', 'google_link', 'mail_link', 'subscribe_content'];
}
