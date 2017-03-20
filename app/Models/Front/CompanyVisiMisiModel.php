<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyVisiMisiModel extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['images', 'title', 'side_description', 'description', 'meta_title', 'meta_keyword', 'meta_description'];
}
