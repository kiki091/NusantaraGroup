<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'side_description', 'quote_description', 'description', 'images', 'meta_keyword', 'meta_title', 'meta_description'];
    public $timestamp = true;
}
