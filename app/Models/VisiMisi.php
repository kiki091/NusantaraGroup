<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['images', 'title', 'side_description', 'description', 'meta_title', 'meta_keyword', 'meta_description'];
}
